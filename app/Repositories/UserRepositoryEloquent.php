<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Repositories\MediaRepositoryEloquent;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public static function storeByRequest($request)
    {
        $media = null;
        if ($request->hasFile('image')) {
            $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'users', 'image');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'media_id' => $media ? $media->id : null,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return $user;
    }

    public static function updateByRequest($request, $user)
    {
        $media = $user->media;
        if ($request->hasFile('image')) {
            if ($user->media && Storage::exists($user?->media?->src)){
                $media = app(MediaRepositoryEloquent::class)->updateByRequest($request->file('image'), 'users', 'image', $user->media);
            }else{
                $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'users', 'image');
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'media_id' => $media ? $media->id : null,
        ]);
        $user->syncRoles($request->role);
        return $user;
    }
    
}
