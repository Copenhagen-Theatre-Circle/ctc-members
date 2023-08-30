<?php

namespace App;

use App\Person;

class MembershipImporter
{
    protected $season;

    public function __construct($season)
    {
        $this->season = $season;
    }

    public function importData()
    {
        $season = $this->season;
        // return $season;
        $seccode = Season::find($season)->seccode;
        // return $seccode;
        $place2bookResponse = json_decode(place2bookShowOrders($seccode));
        // in the edge case with 1 purchase only, place2book returns an object instead of a collection of objects
        if (is_object($place2bookResponse->event->purchases->purchase)) {
            $purchases = array($place2bookResponse->event->purchases->purchase);
        } else {
            $purchases = $place2bookResponse->event->purchases->purchase;
        }
        // membership types mapped to ids here;
        $membershiptype_array = array(1 => 'Single Membership', 2 => 'Family Membership', 3 => '25 or under');

        //********* parse all place2book data into clean data for each member

        // return $purchases;

        foreach ($purchases as $purchase) {
            //up to 4 members per purchase (2 adults, 2 children) - reset arrays:
            $purchaser = array();
            $adult2 = array();
            $child1 = array();
            $child2 = array();
            //set details for purchaser (type, name, mail)
            $purchaser['name'] = trim($purchase->customer->name);
            $purchaser['first_name'] = split_name($purchaser['name'])[0];
            $purchaser['last_name'] = split_name($purchaser['name'])[1];
            $purchaser['mail'] = trim($purchase->customer->email);

            //TO DO: clean up ?? in following logic -> needs to work for array of tickets too!!
            $purchaser['type'] = $purchase->tickets->ticket->type ?? 1;
            $purchaser['type_id'] = array_flip($membershiptype_array)[$purchaser['type']] ?? 1;
            //other members' (adult2, child1 & child2) details parsed from custom fields
            $custom_fields = $purchase->tickets->ticket->custom_fields->custom_field ?? array();
            foreach ($custom_fields as $custom_field) {
                if (!empty((array) $custom_field->value)) {
                    // membership or renewal mapped here
                    if ($custom_field->name == 'Is this a new membership or a renewal?') {
                        $purchaser['new_or_renewal'] = trim($custom_field->value);
                    }
                    // adult 2 name
                    elseif ($custom_field->name == 'Name of Second Adult') {
                        $adult2['name'] = trim($custom_field->value);
                        $adult2['first_name'] = split_name($adult2['name'])[0];
                        $adult2['last_name'] = split_name($adult2['name'])[1];
                        // adult 2 mail
                    } elseif ($custom_field->name == 'E-mail of Second Adult') {
                        $adult2['mail'] = trim($custom_field->value);
                        // child 1 name
                    } elseif ($custom_field->name == 'Name of First Child') {
                        $child1['name'] = trim($custom_field->value);
                        $child1['first_name'] = split_name($child1['name'])[0];
                        $child1['last_name'] = split_name($child1['name'])[1];
                        // child 1 mail
                    } elseif ($custom_field->name == 'E-mail of First Child') {
                        $child1['mail'] = trim($custom_field->value);
                        // child 2 name
                    } elseif ($custom_field->name == 'Name of Second Child') {
                        $child2['name'] = trim($custom_field->value);
                        $child2['first_name'] = split_name($child2['name'])[0];
                        $child2['last_name'] = split_name($child2['name'])[1];
                        // child 2 mail
                    } elseif ($custom_field->name == 'E-mail of Second Child') {
                        $child2['mail'] = trim($custom_field->value);
                    }
                }
            }
            // add purchaser to remapped array
            $purchaser['person_id'] = lookup_or_create_person($purchaser['mail'], $purchaser['first_name'], $purchaser['last_name']);
            $purchaser['purchaser_id'] = $purchaser['person_id'];
            $remapped[] = $purchaser;

            // add remaining info to Adult 2 here and add to remapped array
            if (!empty($adult2)) {
                // if adult 2 is set, copy type, purchaser mail and new or renewal from purchaser
                $adult2['type'] = $purchaser['type'];
                $adult2['type_id'] = $purchaser['type_id'];
                $adult2['purchaser_mail'] = $purchaser['mail'];
                $adult2['purchaser_id'] = $purchaser['person_id'];
                $adult2['new_or_renewal'] = $purchaser['new_or_renewal'];
                $adult2['person_id'] = lookup_or_create_person($adult2['mail'] ?? null, $adult2['first_name'] ?? null, $adult2['last_name'] ?? null);
                $remapped[] = $adult2;
            }
            if (!empty($child1)) {
                $child1['type'] = $purchaser['type'];
                $child1['type_id'] = $purchaser['type_id'];
                $child1['purchaser_mail'] = $purchaser['mail'];
                $child1['purchaser_id'] = $purchaser['person_id'];
                $child1['new_or_renewal'] = $purchaser['new_or_renewal'];
                $child1['person_id'] = lookup_or_create_person($child1['mail'] ?? null, $child1['first_name'] ?? null, $child1['last_name'] ?? null);
                $remapped[] = $child1;
            }
            if (!empty($child2)) {
                $child2['type'] = $purchaser['type'];
                $child2['type_id'] = $purchaser['type_id'];
                $child2['purchaser_mail'] = $purchaser['mail'];
                $child2['purchaser_id'] = $purchaser['person_id'];
                $child2['new_or_renewal'] = $purchaser['new_or_renewal'];
                $child2['person_id'] = lookup_or_create_person($child2['mail'] ?? null, $child2['first_name'] ?? null, $child2['last_name'] ?? null);
                $remapped[] = $child2;
            }
        }
        // return $remapped;

        // ************* create membership entries if necessary ****************
        foreach ($remapped as $membership) {
            $subscription = Membership::updateOrCreate(
                ['person_id' => $membership['person_id'], 'season_id' => (int) $season],
                ['membershiptype_id' => $membership['type_id'], 'person_purchaser_id' => $membership['purchaser_id']]
            );
            $subscriptions[] = $subscription;
        }
        return $subscriptions;
    }
}