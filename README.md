# library-codeigniter-generic-model
Esta es una libreria para poder usar de forma generica la interaccion con la base de datos.<br>

## Ejemplos

Para poder obtener un fila del registro de datos por un arreglo asociativo de datos que coincidan (WHERE)<br>
$user = $this->user_modal->get( [ 'name'=>'henry', 'last_name'=>'perez', 'email'=>'prez.gumiel@gmail.com' ] );<br>
// devolvera $user->name ,$user->last_name ,$user->email<br> 


Para poder obtener un fila del registro de datos por un identificador (ID) unico<br>
$user = $this->user_modal->getById(1554);<br> 
// devolvera $user->name ,$user->last_name ,$user->email<br> 


Para poder crear un registro de datos<br>
$id_user = $this->user_modal->insert( [ 'name'=>'henry', 'last_name'=>'perez', 'email'=>'prez.gumiel@gmail.com' ] );<br>
// devolvera $id_user = 5568<br> 

Para poder actualizar un dato o varios (Primer parametro) utilizando un arreglo asociativo (Segundo Parametro) como WHERE <br>
$this->user_modal->update( [ 'name'=>'henry', 'email'=>'prez.gumiel@gmail.com' ], [ 'status'=>1 ] );<br>

Para poder actualizar un dato o varios (Primer parametro) utilizando un identificador unico (ID) como WHERE <br>
$this->user_modal->updateById( [ 'name'=>'henry', 'email'=>'prez.gumiel@gmail.com' ], 5568 );<br>


Para poder eliminar un dato o varios utilizando un arreglo asociativo como WHERE <br>
$this->user_modal->delete( [ 'status'=>1 ] );<br>


Para poder eliminar un dato o varios utilizando un identificador (ID) como WHERE <br>
$this->user_modal->deleteById( 5568 );<br>


Para poder obtener la cantidad de registros como la function COUNT() de SQL<br>
$count = $this->user_modal->count( [ 'name'=>'henry', [ 'status'=>1 ] );<br>
// devolvera $count = 700<br> 


## Snippet para Sublime Text3
La libreria tiene Snippets para poder usar con el editor de texto Sublime Text3<br>
Estos Snippets tienen las operaciones basicas de get, insert, update, delete y count que son las mas usadas<br>
El grupo de snippets estan en la carpeta "/Snippets para Sublime Text 3"<br>