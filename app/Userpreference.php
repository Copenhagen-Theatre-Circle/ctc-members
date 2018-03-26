<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpreference extends Model
{
      protected $fillable = ['person_id','visibility', 'bulletin_mail_frequency', 'send_CTC_help_bulletins','help_bulletin_scope', 'send_membership_news', 'send_blog_posts', 'remove_data'];
}
