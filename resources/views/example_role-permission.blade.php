

@role('corporate_admin')
    <p>You are a Corporate Admin.</p>
@endrole


@hasanyrole('corporate_admin|super_user')
    <p>You have elevated privileges.</p>
@endhasanyrole

@can('edit events')
    <button>Edit Event</button>
@endcan

{{-- Add to Controller for role permission filtering
public function __construct()
{
    $this->middleware('role:super_user|corporate_admin');
    $this->middleware('permission:manage users')->only(['destroy', 'edit']);
} --}}

{{-- $user->hasRole('franchise_admin')	true/false	Does user have the specified role?
$user->hasAnyRole('role1	role2')`	true/false
$user->hasAllRoles(['r1', 'r2'])	true/false	Does user have all roles?
$user->can('create invoices')	true/false	Does user have the permission?
$user->hasPermissionTo('edit events')	true/false	Explicit permission check
 --}}
