<form action="{{ route('categoria.destroy', $id)}}" method="POST">
     <a href="{{ route('categoria.show', $id)}}"><button type="button" class="btn btn-secondary"><i class="far fa-eye"></i></button></a>
     <a href="{{ route('categoria.edit', $id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
     @csrf
     @method('DELETE')
     <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
     </form>
     
   
   