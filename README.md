# Libreria generic model para CodeIgniter 
Esta es una libreria para poder usar de forma generica la interaccion con la base de datos.<br>

## Ejemplos

Para poder obtener un fila del registro de datos por un arreglo asociativo de datos que coincidan (WHERE)<br>
```
$user = $this->user_model->get( [ 'name'=>'henry', 'last_name'=>'perez', 'email'=>'prez.gumiel@gmail.com' ] );
// devolvera $user->name ,$user->last_name ,$user->email
```

Para poder obtener un fila del registro de datos por un identificador (ID) unico<br>
```
$user = $this->user_model->getById(1554);
// devolvera $user->name ,$user->last_name ,$user->email
```

Para poder obtener un fila del registro de datos por un arreglo asociativo de datos que coincidan (WHERE)<br>
```
$users = $this->user_model->getAll( );
// ó
$users = $this->user_model->getAll( [ 'name'=>'henry', 'last_name'=>'perez', 'email'=>'prez.gumiel@gmail.com' ] );
// devolvera $users[0]['name'] ,$users[0]['last_name'] ,$users[0]['email'] , 
//           $users[1]['name'] ,$users[1]['last_name'] ,$users[1]['email'] 
```

Para poder crear un registro de datos<br>
```
$id_user = $this->user_model->insert( [ 'name'=>'henry', 'last_name'=>'perez', 'email'=>'prez.gumiel@gmail.com' ] );
// devolvera $id_user = 5568
```

Para poder actualizar un dato o varios (Primer parametro) utilizando un arreglo asociativo (Segundo Parametro) como WHERE <br>
```
$this->user_model->update( [ 'name'=>'henry', 'email'=>'prez.gumiel@gmail.com' ], [ 'status'=>1 ] );
```

Para poder actualizar un dato o varios (Primer parametro) utilizando un identificador unico (ID) como WHERE <br>
```
$this->user_model->updateById( [ 'name'=>'henry', 'email'=>'prez.gumiel@gmail.com' ], 5568 );
```

Para poder eliminar un dato o varios utilizando un arreglo asociativo como WHERE <br>
```
$this->user_model->delete( [ 'status'=>1 ] );
```

Para poder eliminar un dato o varios utilizando un identificador (ID) como WHERE <br>
```
$this->user_model->deleteById( 5568 );
```

Para poder obtener la cantidad de registros como la function COUNT() de SQL<br>
```
$count = $this->user_model->count( [ 'name'=>'henry', [ 'status'=>1 ] );
// devolvera $count = 700
```

## Snippet para Sublime Text3
La libreria tiene Snippets para poder usar con el editor de texto Sublime Text3<br>
Estos Snippets tienen las operaciones basicas de get, insert, update, delete y count que son las mas usadas<br>
El grupo de snippets estan en la carpeta "/Snippets para Sublime Text 3"<br>