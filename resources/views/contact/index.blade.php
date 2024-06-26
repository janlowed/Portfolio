@extends('layouts.homelayout')

@section('content')

    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Contact</h2>
                </div>
            </div>
        </div>

        @if ($contacts->count() > 0)
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $contact->first_name }}</td>
                        <td>{{ $contact->last_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>
                            {{-- <!-- <a class="btn btn-primary" href="{{ route('contacts.edit', $contact->id) }}">Edit</a> --> --}}
                            <!-- Delete Button -->
                            @if(Auth::user()->role === 'admin')
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $contact->id }}">Delete</button>
                                @endif

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $contact->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel{{ $contact->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $contact->id }}">Delete
                                                Confirmation</h5>
                                                @if(Auth::user()->role === 'admin')
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            @endif
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete?
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Cancel Button -->
                                            @if(Auth::user()->role === 'admin')
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                                @endif
                                            <!-- Delete Button (inside the form) -->
                                            <form action="{{ route('contacts.destroy',$contact->id) }}" method="Post">
    
                                                <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Edit</a>
                               
                                                @csrf
                                                @method('DELETE')
                                                @if(Auth::user()->role === 'admin')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Want to Delete this About Attachment?')">Delete</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center">No Message Record found!</p>
                </div>
            </div>
        @endif
    </div>
@endsection
