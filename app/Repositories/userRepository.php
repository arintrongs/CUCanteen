<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Save the User.
     *
     * @param  App\Models\User $user
     * @param  Array  $inputs
     * @return bool, true for save succeed
     */
    private function save($user, $inputs)
    {
        if($inputs['id']){ //updating
            $old = User::getUser($inputs['id']);
            if($old->user_id == $inputs['id'] && Hash::check($inputs['password'],$user->user_hpassword)){
                $user->user_username = $inputs['username'];
                $user->user_dispname = $inputs['dispname'];
                $user->user_hpassword = Hash::make($inputs['password']);
                $user->user_disppict = $inputs['disppict'];
                $user->save();
            }
            
        }
    }

    /**
     * Get users collection paginate.
     *
     * @param  int  $n
     * @param  string  $role
     * @return Illuminate\Support\Collection
     */
    public function index($n, $role)
    {
        if($role != 'total')
        {
            return $this->model
            ->with('role')
            ->whereHas('role', function($q) use($role) {
                $q->whereSlug($role);
            })      
            ->oldest('seen')
            ->latest()
            ->paginate($n);         
        }

        return $this->model
        ->with('role')      
        ->oldest('seen')
        ->latest()
        ->paginate($n);
    }

    /**
     * Count the users.
     *
     * @param  string  $role
     * @return int
     */
    public function count($role = null)
    {
        if($role)
        {
            return $this->model
            ->whereHas('role', function($q) use($role) {
                $q->whereSlug($role);
            })->count();            
        }

        return $this->model->count();
    }

    /**
     * Count the users.
     *
     * @param  string  $role
     * @return int
     */
    public function counts()
    {
        $counts = [
            'admin' => $this->count('admin'),
            'redac' => $this->count('redac'),
            'user' => $this->count('user')
        ];

        $counts['total'] = array_sum($counts);

        return $counts;
    }

    /**
     * Create a user.
     *
     * @param  array  $inputs
     * @param  int    $confirmation_code
     * @return App\Models\User 
     */
    public function store($inputs, $confirmation_code = null)
    {
        $user = new $this->model;

        $user->password = bcrypt($inputs['password']);

        if($confirmation_code) {
            $user->confirmation_code = $confirmation_code;
        } else {
            $user->confirmed = true;
        }

        $this->save($user, $inputs);

        return $user;
    }

    /**
     * Update a user.
     *
     * @param  array  $inputs
     * @param  App\Models\User $user
     * @return void
     */
    public function update($inputs, $user)
    {
        $user->confirmed = isset($inputs['confirmed']);

        $this->save($user, $inputs);
    }

    /**
     * Get statut of authenticated user.
     *
     * @return string
     */
    public function getStatut()
    {
        return session('statut');
    }

    /**
     * Valid user.
     *
     * @param  bool  $valid
     * @param  int   $id
     * @return void
     */
    public function valid($valid, $id)
    {
        $user = $this->getById($id);

        $user->valid = $valid == 'true';

        $user->save();
    }

    /**
     * Destroy a user.
     *
     * @param  App\Models\User $user
     * @return void
     */
    public function destroyUser(User $user)
    {
        $user->comments()->delete();

        $posts = $user->posts()->get();

        foreach ($posts as $post) {
            $post->tags()->detach();
            $post->delete();
        }
        
        $user->delete();
    }

    /**
     * Confirm a user.
     *
     * @param  string  $confirmation_code
     * @return App\Models\User
     */
    public function confirm($confirmation_code)
    {
        $user = $this->model->whereConfirmationCode($confirmation_code)->firstOrFail();

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
    }

}
