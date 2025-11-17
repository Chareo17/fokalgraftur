<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Alumni;
use App\Models\Siswa;
use App\Models\Admin;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_topic_id',
        'creator_id',
        'creator_role',
        'reply_content',
    ];

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'creator_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'creator_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'creator_id');
    }

    public function getCreatorNameAttribute()
    {
        if ($this->creator_role === 'Alumni' && $this->alumni) {
            return $this->alumni->name;
        } elseif ($this->creator_role === 'Siswa' && $this->siswa) {
            return $this->siswa->name;
        } elseif ($this->creator_role === 'Admin' && $this->admin) {
            return 'Admin';
        }
        return 'Unknown';
    }
}
