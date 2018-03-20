<?php

function auth_person ($field='id') {
  $person = \Auth::user()->person;
  return $person->$field;
}
