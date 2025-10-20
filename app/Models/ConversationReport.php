<?php
// app/Models/ConversationReport.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationReport extends Model
{
    protected $fillable = ['conversation_id', 'reported_by', 'reason'];


    public function conversation(): hasOne
    {
        return $this->hasOne(Conversation::class);
    }
}
