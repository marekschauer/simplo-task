<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerGroupResource;
use App\Http\Requests\AssignCustomerGroupsRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\CustomerCollection
     */
    public function index()
    {
        $customers = Customer::paginate();

        return new CustomerCollection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer_data = $request->only([
            'username',
            'first_name',
            'last_name',
            'email',
            'phone',
            'active'
        ]);

        $customer = Customer::create($customer_data);

        if ($request->input('group_ids')) {
            $customer->groups()->sync(
                $request->input('group_ids')
            );
        }

        return response()->json([
            'message' => 'The customer has been created',
            'data' => new CustomerResource($customer)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \App\Http\Resources\CustomerResource
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $new_data = $request->only([
            'username',
            'first_name',
            'last_name',
            'email',
            'phone',
            'active'
        ]);

        $customer->fill($new_data);
        $customer->save();

        if ($request->input('group_ids')) {
            $customer->groups()->sync(
                $request->input('group_ids')
            );
        }

        return response()->json([
            'message' => 'The customer has been updated',
            'data' => new CustomerResource($customer)
        ]);
    }

    /**
     * Get the customer groups of given customer
     * 
     * @param  \App\Models\Customer  $customer
     * @return \App\Http\Resources\CustomerGroupResource
     */
    public function groups(Customer $customer)
    {
        return CustomerGroupResource::collection(
            $customer->groups
        );
    }
    
    /**
     * Assign customer groups to given customer.
     * 
     * Any other groups will be detached, only groups present
     * in $request will be assigned to the customer.
     * 
     * @param  \App\Models\Customer  $customer
     * @return \App\Http\Resources\CustomerGroupResource
     */
    public function assignGroups(AssignCustomerGroupsRequest $request, Customer $customer)
    {
        $customer->groups()->sync(
            $request->input('groups_ids')
        );

        return new CustomerResource($customer->fresh(['groups']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer)
    {
        if ($customer->delete()) {
            return response()->json([
                'message' => 'The customer has been deleted.',
                'data' => new CustomerResource($customer)
            ]);
        }

        return response()->json([
            'message' => 'The customer could not be deleted.'
        ], 409);
    }
}
