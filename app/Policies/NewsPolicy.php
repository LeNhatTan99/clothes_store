<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class NewsPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return in_array('view', $this->getPermissions());
    }


    public function view(User $user, News $news)
    {
        return $this->isAuthor($user, $news) || in_array('view', $this->getPermissions());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array('create_news', $this->getPermissions());
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\News  $news
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, News $news)
    {
        return $this->isAuthor($user, $news) || in_array('update_news', $this->getPermissions());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\News  $news
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, News $news)
    {
        if (!$this->isAuthor($user, $news) || !in_array('delete_news', $this->getPermissions())) {
            return back()->with('error', 'User không thể xoá tin tức');
            Response::deny('Tin tức này không phải của bạn.');
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\news  $news
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, News $news)
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\news  $news
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, News $news)
    {
        return $this->isAuthor($user, $news) || in_array('delete_news', $this->getPermissions());
    }

    /**
     * Check is author of post
     *
     * @param User $user user
     * @param News $news News
     *
     * @return boolean
     */
    public function isAuthor(User $user, News $news)
    {
        return $user->id == $news->user_id;
    }
}
