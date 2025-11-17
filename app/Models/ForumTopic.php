<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForumReply;

use App\Models\Alumni;
use App\Models\Siswa;
use App\Models\Admin;

class ForumTopic extends Model
{
    use HasFactory;

    protected $table = 'forum_topics';

    protected $fillable = [
        'judul_topik',
        'isi_topik',
        'kategori',
        'creator_id',
        'creator_role',
    ];

    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'forum_topic_id');
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
