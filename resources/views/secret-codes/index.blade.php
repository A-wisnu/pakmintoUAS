@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-key me-2"></i>My Secret Codes</h4>
                        <form action="{{ route('secret-codes.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Generate New Code
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Secret codes are funny phrases that can be used to log in to your account without a password. 
                        They expire after 7 days or when used once.
                    </div>

                    @if(count($secretCodes) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Funny Phrase</th>
                                    <th>Status</th>
                                    <th>Expires</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($secretCodes as $code)
                                <tr>
                                    <td>
                                        <code>{{ $code->code }}</code>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $code->funny_phrase }}</span>
                                    </td>
                                    <td>
                                        @if($code->is_used)
                                            <span class="badge bg-secondary">Used</span>
                                        @elseif($code->expires_at && $code->expires_at->isPast())
                                            <span class="badge bg-warning text-dark">Expired</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($code->expires_at)
                                            {{ $code->expires_at->format('M d, Y') }}
                                            <small class="d-block text-muted">{{ $code->expires_at->diffForHumans() }}</small>
                                        @else
                                            <em>Never</em>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$code->is_used && (!$code->expires_at || !$code->expires_at->isPast()))
                                        <form action="{{ route('secret-codes.invalidate', $code) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-ban me-1"></i> Invalidate
                                            </button>
                                        </form>
                                        @else
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="fas fa-ban me-1"></i> Invalidate
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-key fa-3x text-muted"></i>
                        </div>
                        <h5>No Secret Codes Yet</h5>
                        <p class="text-muted">Generate your first secret code to enable alternative login method.</p>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    {{ $secretCodes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 