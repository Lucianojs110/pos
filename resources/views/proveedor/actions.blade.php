<form action="{{ route('proveedor.destroy', $id)}}" method="POST">
     <a href="{{ route('proveedor.show', $id)}}"><button type="button" class="btn btn-secondary"><i class="far fa-eye"></i></button></a>
     <a href="{{ route('proveedor.edit', $id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
     @csrf
     @method('DELETE')
     <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
     </form>
     
   
   