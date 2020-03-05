<?php

namespace App\Repositories;

use App\Models\UserStatus;
use App\User;
//use InfyOm\Generator\Common\BaseRepository;
use App\DataTables\Actions\Archive;
use App\Impress\Facades\HtmlField;
use App\DataTables\UserDataTable;
use App\Http\Requests\Request;

/**
 * Class UsersRepository
 * @package App\Repositories
 * @version November 13, 2018, 7:42 pm UTC
 *
 * @method Users findWithoutFail($id, $columns = ['*'])
 * @method Users find($id, $columns = ['*'])
 * @method Users first($columns = ['*'])
*/
class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'balance'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function baseRoute()
    {
        return 'users';
    }

}
