<?php

namespace App\Repositories\Filters;

use App\Repositories\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserFilter implements FilterInterface
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $role;

    /**
     * Set Id
     *
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set Email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set Status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $role
     * @return $this
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Filter
     *
     * @param Builder $query
     * @return Builder
     */
    public function filter(Builder $query): Builder
    {
        if ($this->id) {
            $query->where('id', $this->id);
        }
        if ($this->name) {
            $query->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->email) {
            $query->where('email', 'LIKE', '%' . $this->email . '%');
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->role) {
            $query->where('role', $this->role);
        }

        return $query;
    }

    /**
     * From Request
     *
     * @param Request $request
     * @return $this
     */
    public function fromRequest(Request $request)
    {
        if (!empty($value = $request->get('id'))) {
            $this->setId($value);
        }
        if (!empty($value = $request->get('name'))) {
            $this->setName($value);
        }
        if (!empty($value = $request->get('email'))) {
            $this->setEmail($value);
        }
        if (!empty($value = $request->get('status'))) {
            $this->setStatus($value);
        }
        if (!empty($value = $request->get('role'))) {
            $this->setRole($value);
        }

        return $this;
    }
}
