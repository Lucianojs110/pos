<form action="{{ route('articulo.destroy', $id)}}" method="POST">
     <a href="{{ route('articulo.show', $id)}}"><button type="button" class="btn btn-light btn-sm"><i class="far fa-eye"></i></button></a>
     <a href="{{ route('articulo.edit', $id)}}"><button type="button" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></button></a>
     @csrf
     @method('DELETE')
     <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-trash-alt"></i></button>
     </form>
     
   
   