
     
     <form action="{{ route('usuarios.destroy', $id)}}" method="POST">
     <a href="{{ route('usuarios.show', $id)}}"><button type="button" class="btn btn-light btn-sm"><i class="far fa-eye"></i></button></a>
     <a href="{{ route('usuarios.edit', $id)}}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></button></a>
     @csrf
     @method('DELETE')
     <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-trash-alt"></i></button>
     </form>
     
   
   