
@foreach($subcategories as $subcategory)
<ul>
   <li class="child">
       {{$subcategory->title}}
       @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions) || in_array('create',$active_permissions)) 
       @if (in_array('create',$active_permissions))
         <a href="{{route('category.add.view',['role' => \Auth::user()->role->slug, 'parent' => $subcategory->id ])}}">
           <button class="btn success">
             <i class="fas fa-plus-square"></i>
           </button>
         </a>
       @endif
       @if (in_array('update',$active_permissions))
         <a href="{{route('category.edit.view',['role' => \Auth::user()->role->slug, 'parent' => $subcategory->id ])}}">
           <button class="btn info">
             <i class="far fa-edit"></i>
           </button>
         </a>
       @endif
       @if (in_array('delete',$active_permissions))
         <a class="delete-confirmation" href="{{route('category.delete.form',['role' => \Auth::user()->role->slug, 'id' => $subcategory->id ])}}">
           <button class="btn danger">
             <i class="far fa-trash-alt"></i>
           </button>
         </a>
       @endif
     @endif
    </li> 
 @if(count($subcategory->children))
   @include('Categories::partials.sub-categories',['subcategories' => $subcategory->children])
 @endif
</ul> 
@endforeach
