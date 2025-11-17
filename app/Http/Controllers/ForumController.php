<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ForumController extends Controller
{
    // Menampilkan halaman utama forum dengan topik dan balasan
    public function index()
    {
        $topics = ForumTopic::with(['replies.alumni', 'replies.siswa', 'replies.admin', 'alumni', 'siswa', 'admin'])->latest()->get();

        // Append creator_name and human readable created_at for topics and replies
        $topics->transform(function ($topic) {
            $topic->setAttribute('creator_name', $topic->creator_name);
            $topic->setAttribute('time_ago', $topic->created_at->diffForHumans());

            // Add creator_identifier for avatar
            if ($topic->creator_role === 'Alumni' && $topic->alumni) {
                $topic->setAttribute('creator_identifier', $topic->alumni->username);
                $topic->setAttribute('profile_image', $topic->alumni->profile_image);
            } elseif ($topic->creator_role === 'Siswa' && $topic->siswa) {
                $topic->setAttribute('creator_identifier', $topic->siswa->username);
                $topic->setAttribute('profile_image', $topic->siswa->profile_image);
            } elseif ($topic->creator_role === 'Admin') {
                $topic->setAttribute('creator_identifier', 'admin');
                $topic->setAttribute('profile_image', null);
            } else {
                $topic->setAttribute('creator_identifier', 'user');
                $topic->setAttribute('profile_image', null);
            }

            $topic->replies->transform(function ($reply) {
                $reply->setAttribute('creator_name', $reply->creator_name);
                $reply->setAttribute('created_at_human', $reply->created_at->diffForHumans());

                // Add creator_identifier for reply avatar
                if ($reply->creator_role === 'Alumni' && $reply->alumni) {
                    $reply->setAttribute('creator_identifier', $reply->alumni->username);
                    $reply->setAttribute('profile_image', $reply->alumni->profile_image);
                } elseif ($reply->creator_role === 'Siswa' && $reply->siswa) {
                    $reply->setAttribute('creator_identifier', $reply->siswa->username);
                    $reply->setAttribute('profile_image', $reply->siswa->profile_image);
                } elseif ($reply->creator_role === 'Admin') {
                    $reply->setAttribute('creator_identifier', 'admin');
                    $reply->setAttribute('profile_image', null);
                } else {
                    $reply->setAttribute('creator_identifier', 'user');
                    $reply->setAttribute('profile_image', null);
                }

                return $reply;
            });

            return $topic;
        });

        return view('forum', compact('topics'));
    }

    // Menyimpan topik baru
    public function store(Request $request)
    {
$request->validate([
    'judul_topik' => 'required|string|max:255|unique:forum_topics,judul_topik',
    'kategori' => 'required|string|in:umum,karier,pendidikan',
    'isi_topik' => 'required|string|max:1000',
]);

        $user = Auth::user();
        $creator_id = $user ? $user->id : null;

        // Determine user role more reliably
        if ($user) {
            if (auth()->guard('admin')->check()) {
                $creator_role = 'Admin';
            } elseif (auth()->guard('alumni')->check()) {
                $creator_role = 'Alumni';
            } elseif (auth()->guard('siswa')->check()) {
                $creator_role = 'Siswa';
            } else {
                $creator_role = 'User';
            }
        } else {
            $creator_role = 'Admin';
        }

        try {
            ForumTopic::create([
                'judul_topik' => $request->judul_topik,
                'kategori' => $request->kategori,
                'isi_topik' => $request->isi_topik,
                'creator_id' => $creator_id,
                'creator_role' => $creator_role,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save forum topic: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat topik');
        }

        return redirect()->route('forum')->with('success', 'Topik berhasil dibuat!');
    }

    // Menyimpan balasan diskusi
    public function storeReply(Request $request, $topicId)
    {
        try {
            $request->validate([
                'reply_content' => 'required|string|max:1000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Balasan tidak boleh lebih dari 1000 karakter.'], 422);
        }

        $user = Auth::user();
        Log::debug('Authenticated user:', ['user' => $user]);
        $creator_id = $user ? $user->id : null;

        // Determine user role more reliably
        if ($user) {
            if (auth()->guard('admin')->check()) {
                $creator_role = 'Admin';
            } elseif (auth()->guard('alumni')->check()) {
                $creator_role = 'Alumni';
            } elseif (auth()->guard('siswa')->check()) {
                $creator_role = 'Siswa';
            } else {
                $creator_role = 'User';
            }
        } else {
            $creator_role = 'Admin';
        }

        try {
            ForumReply::create([
                'forum_topic_id' => $topicId,
                'reply_content' => $request->reply_content,
                'creator_id' => $creator_id,
                'creator_role' => $creator_role,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save forum reply: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengirim balasan'], 500);
        }

        return response()->json(['message' => 'Balasan berhasil dikirim']);
    }

    // Delete a forum topic by ID
    public function destroy($id)
    {
        try {
            $topic = ForumTopic::findOrFail($id);
            $topic->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Failed to delete forum topic: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Gagal menghapus topik');
        }
    }
}
