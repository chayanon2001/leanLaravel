@extends('layouts.app')
@section('title', 'Blog')
@section('content')
 @if (count($blogs)>0)
 <h2 class="text-center py-2">All articles</h2>
 <table class="table table-bordered table-striped">
     <thead class="thead-dark">
         <tr>
             <th scope="col" class="text-center">Article title</th>
             <th scope="col" class="text-center">Content</th>
             <th scope="col" class="text-center">Status</th>
             <th scope="col" class="text-center">Edit Article</th>
             <th scope="col" class="text-center">Delete Article</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($blogs as $item)
             <tr>
                 <td>{{ $item->title }}</td>
                 <td>{!!Str::limit($item->content, 20)!!}</td>
                 <td class="text-center">
                     @if ($item->status)
                         <span class="badge bg-success">
                             <a href="{{ route('change', $item->id) }}"
                                 class="text-white text-decoration-none">Publish</a>
                         </span>
                     @else
                         <span class="badge bg-primary">
                             <a href="{{ route('change', $item->id) }}"
                                 class="text-white text-decoration-none">Adjust</a>
                         </span>
                     @endif
                 </td>
                 <td class="text-center">
                     <a href="{{ route('edit', $item->id) }}"" class="btn btn-outline-warning">Edit</a>
                 </td>
                 <td class="text-center">
                     <button class="btn btn-outline-danger"
                         onclick="confirmDelete('{{ route('delete', $item->id) }}', '{{ $item->title }}')">Delete</button>
                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>
 {{ $blogs->links() }}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     function confirmDelete(url, title) {
         Swal.fire({
             title: 'Please confirm deletion.',
             text: `Want to delete "${title}"`,
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, Delete it now!',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.isConfirmed) {
                 // First, show the success message and then redirect
                 Swal.fire({
                     title: 'Deleted!',
                     text: 'Your article has been deleted.',
                     icon: 'success',
                     timer: 1500, // Optional: auto-close after 1.5 seconds
                     willClose: () => {
                         window.location.href = url; // Navigate after the success message is shown
                     }
                 });
             }
         });
     }
 </script>
 
 @else
 <h2 class="text-center py-2">There are no articles in the system.</h2>

 @endif
@endsection

