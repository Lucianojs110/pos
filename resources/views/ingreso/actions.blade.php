
     
     <form action="{{ route('ingreso.destroy', $id)}}" method="POST">
     <a href="{{ route('ingreso.show', $id)}}"><button type="button" class="btn btn-secondary"><i class="far fa-eye"></i></button></a>
     
     @csrf
     @method('DELETE')
     <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
     </form>
     
   
   