@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><i class="fas fa-user mr-2"></i>Detail Profile</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('edit_profile') }}" method="post" id="profileForm">
                        @csrf

                        <div class="form-group">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" disabled required>
                        </div>

                        <div class="form-group">
                            <label for="nis"><strong>NIS</strong></label>
                            <input type="text" id="nis" name="nis" class="form-control" value="{{ old('nis', $user->nis) }}" disabled required>
                        </div>

                       <div class="form-group">
                            <label for="tahun_ajaran"><strong>Tahun Ajaran</strong></label>
                            <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran', $user->nis) }}" disabled required>
                        </div>

                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="role"><strong>Role</strong></label><br>
                            @if($user->is_admin)
                                <span class="badge badge-success">Admin</span>
                            @else
                                <span class="badge badge-primary">Siswa</span>
                            @endif
                        </div>

                        <div id="passwordFields" style="display: none;">
                            <hr>
                            <div class="form-group">
                                <label for="password"><strong>Password Baru</strong></label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation"><strong>Konfirmasi Password</strong></label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="ulangi password">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="editButton">
                                <i class="fas fa-edit mr-1"></i>Edit Profile
                            </button>
                            <button type="submit" class="btn btn-primary" id="saveButton" style="display: none;">
                                <i class="fas fa-save mr-1"></i>Save Changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('editButton').addEventListener('click', function() {
        // Enable form inputs
        document.getElementById('name').disabled = false;
        document.getElementById('nis').disabled = false;
        document.getElementById('tahun_ajaran').disabled = false;
        document.getElementById('passwordFields').style.display = 'block';

        // Show Save button, hide Edit button
        document.getElementById('saveButton').style.display = 'inline-block';
        this.style.display = 'none';
    });
</script>
@endsection
