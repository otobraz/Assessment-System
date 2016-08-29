<div class="table ">
   <table class="table table-striped table-hover">

      <tr>
         <th>Id</th>
         <th>Usuário</th>
      </tr>

      @foreach($admins as $admin)
         <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->username}}</td>
         </tr>
      @endforeach

   </table>
</div>
