<?php 
    include 'auth.php'; 
    include 'conexao.php'; 

   

    function is_image_or_pdf($image_type)
    {
        if(in_array($image_type ,  array("image/png", "image/jpeg", "image/jpg", "application/pdf", "image/gif")))
        {
            return true;
        }

        return false;
    } 

    $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : '';


    switch ($modulo) {
        case 'add-user':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $senha = isset($_POST['senha']) ? md5($_POST['senha']) : '';
            $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
            $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
            $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
            $permissao = isset($_POST['permissao']) ? $_POST['permissao'] : '';

            

            $insert = "INSERT INTO Usuario (nome, email, senha, permissao, telefone, celular, funcao, unidade, status, foto) 
            VALUES ('" . addslashes($nome) . "', '" . addslashes($email) . "', '" . addslashes($senha) . "', '" . addslashes($permissao) . "', '" . addslashes($telefone) . "', '" . addslashes($celular) . "', '" . addslashes($funcao) . "', '" . addslashes($unidade) . "', 'A', 'assets/img/avatar/user.svg');";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Usuario",
		        "' .  $insert . '", 
		        "Usuário -> ' . addslashes($nome) . '")';

		    mysqli_multi_query($conn, $insert);

            $id = $conn->insert_id;
            

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {

            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           

            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/usuarios/" .$id. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/usuarios/". $id;

                        if(!file_exists($path))
                        {	
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/usuarios/' . $id . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Usuario SET foto = '".$urlFile."' WHERE id = {$id}"; 

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               }  
        }          

        die(json_encode($retorno));

        break;


        case 'edt-user':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $senha = isset($_POST['senha']) ? md5($_POST['senha']) : '';
            $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
            $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
            $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
            $permissao = isset($_POST['permissao']) ? $_POST['permissao'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $id_us = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';

            if($senha != ''){
                $insert =" UPDATE Usuario SET email = '" . addslashes($email) . "', senha ='" . addslashes($senha) . "' , permissao ='" . addslashes($permissao) . "', nome = '" . addslashes($nome) . "', telefone = '" . addslashes($telefone) . "', celular = '" . addslashes($celular) . "', status = '" . addslashes($status) . "', funcao = '" . addslashes($funcao) . "', unidade = '" . addslashes($unidade) . "' WHERE id = '" . addslashes($id_us) . "';";

	            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Usuario",
		        "' .  $insert . '", 
		        "Usuário -> ' . addslashes($nome) . '")';

		    
            }else{
                $insert =" UPDATE Usuario SET email = '" . addslashes($email) . "', permissao ='" . addslashes($permissao) . "', nome = '" . addslashes($nome) . "', telefone = '" . addslashes($telefone) . "', celular = '" . addslashes($celular) . "', status = '" . addslashes($status) . "', funcao = '" . addslashes($funcao) . "', unidade = '" . addslashes($unidade) . "' WHERE id = '" . addslashes($id_us) . "';";

                $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Usuario",
		        "' .  $insert . '", 
		        "Usuário -> ' . addslashes($nome) . '")';

            }              
            mysqli_multi_query($conn, $insert);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/usuarios/" .$id_us. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/usuarios/". $id_us;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/usuarios/' . $id_us . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Usuario SET foto = '".$urlFile."' WHERE id = {$id_us}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               
            }  
        }          

        die(json_encode($retorno));

        break;

        case 'exc-all':

            $check = is_array($_POST['check']) ? implode(", ", $_POST['check']) : '';
            $nome_del = '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Usuario WHERE id IN ({$check})");
            $conta = 0;

            while($nome_user = mysqli_fetch_array($pega_nome)){
                if ($conta >= 1) {
                    $nome_del = $nome_del .',  '. $nome_user['nome'];
                }else{
                   $nome_del = $nome_user['nome'];
                }
                $conta++;
            }
                
            
            $delete = "DELETE FROM `Usuario` WHERE id IN({$check});";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Usuario",
		        "' .  $delete . '", 
		        "Usuários com os seguintes nomes -> ' . $nome_del . '")';


            mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }
              
            die(json_encode($retorno));
        break;

        case 'exc-all-sfp':

            $check = is_array($_POST['check']) ? implode(", ", $_POST['check']) : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Sfp WHERE id IN ({$check})");
            $conta = 0;

            while($nome_user = mysqli_fetch_array($pega_nome)){

                if ($conta >= 1) {
                    $nome_del = $nome_del .',  '. $nome_user['nome'];
                }else{
                   $nome_del = $nome_user['nome'];
                }
                $conta++;
            }

            $delete = "DELETE FROM `Sfp` WHERE id IN({$check});";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Sfp",
		        "' .  $delete . '", 
		        "SFPs com os seguintes nomes -> ' . $nome_del . '")';


            mysqli_multi_query($conn, $delete);


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }
              
            die(json_encode($retorno));
        break;


        case 'exc-unc':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Usuario WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            $delete = "DELETE FROM `Usuario` WHERE id = {$id_del};";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Usuario",
		        "' .  $delete . '", 
		        "Usuário com o seguinte nome-> ' . addslashes($nome_user['nome']) . '")';


            mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        case 'exc-unc-sfp':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Sfp WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            $delete = "DELETE FROM `Sfp` WHERE id = {$id_del};";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Sfp",
		        "' .  $delete . '", 
		        "SFP com o seguinte nome -> ' . addslashes($nome_user['nome']) . '")';


            mysqli_multi_query($conn, $delete);


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;


        case 'add-tec':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
            $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
            $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';

            

            $insert = "INSERT INTO Tecnico (nome, telefone, celular, funcao, unidade, status) 
            VALUES ('" . addslashes($nome) . "', '" . addslashes($telefone) . "', '" . addslashes($celular) . "', '" . addslashes($funcao) . "', '" . addslashes($unidade) . "', 'A');";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Tecnico",
		        "' .  $insert . '", 
		        "Técnico -> ' . addslashes($nome) . '")';

		    mysqli_multi_query($conn, $insert);


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {    
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));

        break;

        case 'edt-tec':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
            $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
            $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $id_tec = isset($_POST['id_tec']) ? $_POST['id_tec'] : '';

            
            $insert =" UPDATE Tecnico SET nome = '" . addslashes($nome) . "', telefone = '" . addslashes($telefone) . "', celular = '" . addslashes($celular) . "', status = '" . addslashes($status) . "', funcao = '" . addslashes($funcao) . "', unidade = '" . addslashes($unidade) . "' WHERE id = '" . addslashes($id_tec) . "';";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Tecnico",
		        "' .  $insert . '", 
		        "Técnico -> ' . addslashes($nome) . '")';
                       
            mysqli_multi_query($conn, $insert);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                 $retorno = ['status' => 'success'];
                       
            }

            die(json_encode($retorno));

        break;

        case 'exc-all-tec':

            $check = is_array($_POST['check']) ? implode(", ", $_POST['check']) : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Tecnico WHERE id IN ({$check})");
            $conta = 0;

            while($nome_user = mysqli_fetch_array($pega_nome)){
                if ($conta >= 1) {
                    $nome_del = $nome_del .',  '. $nome_user['nome'];
                }else{
                   $nome_del = $nome_user['nome'];
                }
                $conta++;
            }

            $delete = "DELETE FROM `Tecnico` WHERE id IN({$check});";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Tecnico",
		        "' .  $delete . '", 
		        "Tecnicos com os seguintes nomes -> ' . $nome_del . '")';

            mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }
              
            die(json_encode($retorno));
        break;

        case 'exc-unc-tec':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';


            $pega_nome= mysqli_query($conn, "SELECT nome FROM Tecnico WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            $delete = "DELETE FROM `Tecnico` WHERE id = {$id_del};";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Tecnico",
		        "' .  $delete . '", 
		        "Técnico com o seguinte nome -> ' . addslashes($nome_user['nome']) . '")';

            mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        case 'add-sfp':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $alcance = isset($_POST['alcance']) ? ($_POST['alcance']) : '';
            $velocidade = isset($_POST['velocidade']) ? $_POST['velocidade'] : '';
            $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
            $transmissao = isset($_POST['transmissao']) ? $_POST['transmissao'] : '';
            $fabricante = isset($_POST['fabricante']) ? $_POST['fabricante'] : '';
            $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';

            

            $insert = "INSERT INTO Sfp (nome, descricao, alcance, velocidade, quantidade, transmissao, fabricante_id, modelo_id, status, foto) 
            VALUES ('" . addslashes($nome) . "', '" . addslashes($descricao) . "', '" . addslashes($alcance) . "', '" . addslashes($velocidade) . "', '" . addslashes($quantidade) . "', '" . addslashes($transmissao) . "', '" . addslashes($fabricante) . "', '" . addslashes($modelo) . "', 'A', 'assets/img/avatar/sfp12.png');";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Sfp",
		        "' .  $insert . '", 
		        "SFP -> ' . addslashes($nome) . '")';

		    mysqli_multi_query($conn, $insert);

            $conn->insert_id;
            $id = $conn->insert_id;


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/sfp/" .$id. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/sfp/". $id;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/sfp/' . $id . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Sfp SET foto = '".$urlFile."' WHERE id = {$id}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.']; 
                                                              }  
        }          

        die(json_encode($retorno));

        break;

        case 'edt-sfp':
            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $alcance = isset($_POST['alcance']) ? $_POST['alcance'] : '';
            $velocidade = isset($_POST['velocidade']) ? $_POST['velocidade'] : '';
            $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
            $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
            $fabricante = isset($_POST['fabricante']) ? $_POST['fabricante'] : '';
            $transmissao = isset($_POST['transmissao']) ? $_POST['transmissao'] : '';
            $id_us = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';

            $insert =" UPDATE Sfp SET nome = '" . addslashes($nome) . "', descricao ='" . addslashes($descricao) . "', alcance = '" . addslashes($alcance) . "', velocidade = '" . addslashes($velocidade) . "', quantidade = '" . addslashes($quantidade) . "', modelo_id = '" . addslashes($modelo) . "', fabricante_id = '" . addslashes($fabricante) . "', transmissao = '" . addslashes($transmissao) . "' WHERE id = '" . addslashes($id_us) . "';"; 

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Sfp",
		        "' .  $insert . '", 
		        "SFP -> ' . addslashes($nome) . '")';            

            mysqli_multi_query($conn, $insert);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                          
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/sfp/" .$id_us. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/sfp/". $id_us;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/sfp/' . $id_us . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Sfp SET foto = '".$urlFile."' WHERE id = {$id_us}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               
            }  
        }          

        die(json_encode($retorno));

        break;

        case 'add-chave':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';

            

            $insert = "INSERT INTO Chave (nome, descricao, unidade, status, disponibilidade, foto) 
            VALUES ('" . addslashes($nome) . "', '" . addslashes($descricao) . "', '" . addslashes($unidade) . "', 'A', 'D', 'assets/img/avatar/chave1.png');";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Chave",
		        "' .  $insert . '", 
		        "Chave -> ' . addslashes($nome) . '")';

		    mysqli_multi_query($conn, $insert);

            $conn->insert_id;
            $id = $conn->insert_id;

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/chave/" .$id. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/chave/". $id;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/chave/' . $id . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Usuario SET foto = '".$urlFile."' WHERE id = {$id}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               }  
        }          

        die(json_encode($retorno));

        break;

        case 'edt-chave':
            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $id_us = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';


            $insert =" UPDATE Chave SET nome = '" . addslashes($nome) . "', descricao ='" . addslashes($descricao) . "', unidade = '" . addslashes($unidade) . "', status = '" . addslashes($status) . "'  WHERE id = '" . addslashes($id_us) . "' ;";             

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Chave",
		        "' .  $insert . '", 
		        "Chave -> ' . addslashes($nome) . '")';

			mysqli_multi_query($conn, $insert);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';    

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/chave/" .$id_us. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/chave/". $id_us;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/chave/' . $id_us . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Chave SET foto = '".$urlFile."' WHERE id = {$id_us}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               
            }  
        }          

        die(json_encode($retorno));

        break;

        case 'exc-all-chave':

            $check = is_array($_POST['check']) ? implode(", ", $_POST['check']) : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Chave WHERE id IN ({$check})");
            $conta = 0;
            
            while($nome_user = mysqli_fetch_array($pega_nome)){

                if ($conta >= 1) {
                    $nome_del = $nome_del .',  '. $nome_user['nome'];
                }else{
                   $nome_del = $nome_user['nome'];
                }
                $conta++;

            }

            $delete = "DELETE FROM `Chave` WHERE id IN({$check});";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Chave",
		        "' .  $delete . '", 
		        "Chaves com os seguintes nomes -> ' . $nome_del . '")';

			mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }
              
            die(json_encode($retorno));
        break;

        case 'exc-unc-chave':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Chave WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            $delete = "DELETE FROM `Chave` WHERE id = {$id_del};";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Chave",
		        "' .  $delete . '", 
		        "Chave com o seguinte nome-> ' . addslashes($nome_user['nome']) . '")';


			mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        case 'dev-chave':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome = mysqli_query($conn, "SELECT nome FROM Chave WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);


            $dev = "UPDATE Chave SET disponibilidade = 'D', Tecnico_id = NULL, Usuario_id = NULL, uptime = CURRENT_TIMESTAMP WHERE id = {$id_del};";

            $dev .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Chave",
		        "' .  $dev . '", 
		        "Devolvido chave -> ' . addslashes($nome_user['nome']) . '");';

            $dev .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Chave", "D", "1")';

			mysqli_multi_query($conn, $dev);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        case 'retirar-chave':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';
            $id_tecnico = isset($_POST['id_tecnico']) ? $_POST['id_tecnico'] : '';
            $id_us = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '';

            $pega_nome = mysqli_query($conn, "SELECT nome FROM Chave WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            if ($id_tecnico == 'usuario') {
                $ret = "UPDATE Chave SET disponibilidade = 'I', Tecnico_id = NULL, Usuario_id = '". addslashes($id_us) ."' , uptime = CURRENT_TIMESTAMP WHERE id = {$id_del};";

                $ret .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Chave",
		        "' .  $ret . '", 
		        "Retirado chave ' . addslashes($nome_user['nome']) . ', pelo usuário ' . addslashes($_SESSION['usuario']) . '");';

                $ret .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Chave", "R", "1")';

            }else{

                $pega_nome_tec = mysqli_query($conn, "SELECT nome FROM Tecnico WHERE id= {$id_tecnico}");
                $nome_tec = mysqli_fetch_array($pega_nome_tec);

                    $ret = "UPDATE Chave SET disponibilidade = 'I', Tecnico_id = '". addslashes($id_tecnico) ."', Usuario_id = '". addslashes($id_us) ."', uptime = CURRENT_TIMESTAMP WHERE id = {$id_del};";

                    $ret .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
        		        VALUES (' .$_SESSION['idUsuario'].  ', 
        		        "Chave",
        		        "' .  $ret . '", 
        		        "Retirado chave ' . addslashes($nome_user['nome']) . ', pelo usuário ' . addslashes($_SESSION['usuario']) . ' e entregue para o técnico ' . addslashes($nome_tec['nome']) . '");';

                $ret .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Chave", "R", "1")';

                } 

            mysqli_multi_query($conn, $ret);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        case 'retirar-sfp':


            $id_del = isset($_POST['id']) ? $_POST['id'] : '';
            $id_tecnico = isset($_POST['id_tecnico']) ? $_POST['id_tecnico'] : '';
            $quantidade = isset($_POST['qtd']) ? $_POST['qtd'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
            $desc = isset($_POST['desc']) ? $_POST['desc'] : '';

            $pega_nome = mysqli_query($conn, "SELECT nome FROM Sfp WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);
            
            $pega_qty = mysqli_query($conn, "SELECT quantidade FROM Sfp WHERE id = {$id_del}");
            if($qty = mysqli_fetch_assoc($pega_qty)){
                $qty_atual = $qty['quantidade'];
            }

                if($quantidade <= 0){
                    $retorno = ['status' => 'error', 'error' => 'Certifique-se de que a quantidade selecionada seja válida.'];
                }elseif($quantidade > $qty_atual){
                    $retorno = ['status' => 'error', 'error' => 'Você tentou retirar uma quantidade superior à disponível em nosso estoque, verifique e tente novamente.'];
                }else{

                if ($id_tecnico == 'usuario') {

                    $ret = "UPDATE Sfp SET quantidade = quantidade - {$quantidade} WHERE id = {$id_del};";

                    $ret .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                    VALUES (' .$_SESSION['idUsuario'].  ', 
                    "Sfp",
                    "' .  $ret . '", 
                    "Retirado SFP -> ' . addslashes($nome_user['nome']) . ', pelo o usuário: ' . $_SESSION['usuario']. ', para utilizar na unidade: ' . $unidade . ' quantidade retirada: ' . $quantidade . ', pelo motivo: ' . $desc . '");';

                     $ret .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Sfp", "R", ' . addslashes($quantidade) . ')';

                }else{
                    $pega_nome_tec = mysqli_query($conn, "SELECT nome FROM Tecnico WHERE id= {$id_tecnico}");
                    $nome_tec = mysqli_fetch_array($pega_nome_tec);

                    $ret = "UPDATE Sfp SET quantidade = quantidade - {$quantidade} WHERE id = {$id_del};";

                    $ret .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                    VALUES (' .$_SESSION['idUsuario'].  ', 
                    "Sfp",
                    "' .  $ret . '", 
                    "Retirado SFP -> ' . addslashes($nome_user['nome']) . ', pelo o usuário: ' . $_SESSION['usuario']. ', para o técnico: ' . addslashes($nome_tec['nome']) . ', para utilizar na unidade: ' . $unidade . ', quantidade retirada: ' . $quantidade . ', pelo motivo: ' . $desc . '");';

                    $ret .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Sfp", "R", ' . addslashes($quantidade) . ')';

                } 

                mysqli_multi_query($conn, $ret);

                if($conn->error)
                {
                    $retorno = ['status' => 'error', 'erro' => $conn->error];                   
                }
                else
                {
                    $retorno = ['status' => 'success'];
                }
            }
            die(json_encode($retorno));
            
        break;

        case 'add-fab':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

            $insert = "INSERT INTO Fabricante (nome, status) 
            VALUES ('" . addslashes($nome) . "', 'A');";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Fabricante",
                "' .  $insert . '", 
                "Fabricante -> ' . addslashes($nome) . '")';

            mysqli_multi_query($conn, $insert);


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {    
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));

        break;

        case 'edt-fab':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $id_fab = isset($_POST['id_fab']) ? $_POST['id_fab'] : '';

            
            $insert =" UPDATE Fabricante SET nome = '" . addslashes($nome) . "', status = '" . addslashes($status) . "' WHERE id = '" . addslashes($id_fab) . "';";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Fabricante",
                "' .  $insert . '", 
                "Fabricante -> ' . addslashes($nome) . '")';
                       
            mysqli_multi_query($conn, $insert);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                 $retorno = ['status' => 'success'];
                       
            }

            die(json_encode($retorno));

        break;
        case 'exc-all-fab':

            
            $check = is_array($_POST['check']) ? implode(", ", $_POST['check']) : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Fabricante WHERE id IN ({$check})");
            $conta = 0;

            while($nome_user = mysqli_fetch_array($pega_nome)){
                if ($conta >= 1) {
                    $nome_del = $nome_del .',  '. $nome_user['nome'];
                }else{
                   $nome_del = $nome_user['nome'];
                }
                $conta++;
            }

            $delete = "DELETE FROM `Fabricante` WHERE id IN({$check});";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Fabricante",
                "' .  $delete . '", 
                "Fabricante(s) com os seguintes nomes -> ' . $nome_del . '")';

            mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }
              
            die(json_encode($retorno));
        break;

        case 'exc-unc-fab':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Fabricante WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            $delete = "DELETE FROM `Fabricante` WHERE id = {$id_del};";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Fabricante",
                "' .  $delete . '", 
                "Fabricante com o seguinte nome -> ' . addslashes($nome_user['nome']) . '")';

            mysqli_multi_query($conn, $delete);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;
        case 'edt-usuario':

            $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $telefone = isset($_POST['edit-telefone']) ? $_POST['edit-telefone'] : '';
            $celular = isset($_POST['edit-celular']) ? $_POST['edit-celular'] : '';
            $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : '';
            $unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
            $senha_nova = isset($_POST['new-pass']) ? $_POST['new-pass'] : '';
            $senha_ant = isset($_POST['old-pass']) ? md5($_POST['old-pass']) : '';          
            $senha_rep = isset($_POST['retype-pass']) ? $_POST['retype-pass'] : '';
            $id_us = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';

            $query_user = "SELECT * FROM `Usuario` WHERE id ='" . addslashes($id_us) . "'";

            $user_senha = mysqli_query($conn, $query_user);
            $teste = mysqli_fetch_assoc($user_senha);

                if($senha_nova != ''){

                    if ($senha_nova == $senha_rep && $senha_ant == $teste['senha'] ) {

                        $senha_nova = md5($senha_nova);


                        $insert =" UPDATE Usuario SET email = '" . addslashes($email) . "', senha ='" . addslashes($senha_nova) . "' , nome = '" . addslashes($nome) . "', telefone = '" . addslashes($telefone) . "', celular = '" . addslashes($celular) . "', funcao = '" . addslashes($funcao) . "', unidade = '" . addslashes($unidade) . "' WHERE id = '" . addslashes($id_us) . "';";

                        $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                        VALUES (' .$_SESSION['idUsuario'].  ', 
                        "Usuario",
                        "' .  $insert . '", 
                        "O usuário -> ' . addslashes($nome) . ' editou seu perfil")';
                    }else{
                        $retorno = ['status' => 'error', 'error' => 'Ops... Você digitou algum campo errado no editar senha'];

                                    die(json_encode($retorno));

                        }
                     
                }else{
                    $insert =" UPDATE Usuario SET email = '" . addslashes($email) . "', nome = '" . addslashes($nome) . "', telefone = '" . addslashes($telefone) . "', celular = '" . addslashes($celular) . "', funcao = '" . addslashes($funcao) . "', unidade = '" . addslashes($unidade) . "' WHERE id = '" . addslashes($id_us) . "';";

                    $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                    VALUES (' .$_SESSION['idUsuario'].  ', 
                    "Usuario",
                    "' .  $insert . '", 
                    "O usuário -> ' . addslashes($nome) . ' editou seu perfil")';

                }              

                mysqli_multi_query($conn, $insert);
                    
            

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['fileUpload2'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['fileUpload2'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/usuarios/" .$id_us. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/usuarios/". $id_us;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/usuarios/' . $id_us . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Usuario SET foto = '".$urlFile."' WHERE id = {$id_us}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               
            }  
        }          

        die(json_encode($retorno));

        break;

        case 'add-roteador':

            // var_dump($_POST);
            // die();

            $local = isset($_POST['local']) ? $_POST['local'] : '';
            $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
            $fabricante = isset($_POST['fabricante']) ? $_POST['fabricante'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $serial = isset($_POST['serial']) ? $_POST['serial'] : '';           
            

            $insert = "INSERT INTO Roteador (local, modelo, descricao, serial, fabricante_id, status, disponibilidade, foto) 
            VALUES ('" . addslashes($local) . "', '" . addslashes($modelo) . "', '" . addslashes($descricao) . "', '" . addslashes($serial)  . "', '" . addslashes($fabricante) . "', 'A', 'D', 'assets/img/avatar/roteador.png');";

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Roteador",
		        "' .  $insert . '", 
		        "Roteador -> ' . addslashes($modelo) . '")';

		    mysqli_multi_query($conn, $insert);

            $conn->insert_id;
            $id = $conn->insert_id;

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                           
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/roteador/" .$id. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/roteador/". $id;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/roteador/' . $id . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Roteador SET foto = '".$urlFile."' WHERE id = {$id}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi adicionado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.']; 
                                                              }  
        }          

        die(json_encode($retorno));

        break;

        case 'edt-roteador':
            $local = isset($_POST['local']) ? $_POST['local'] : '';
            $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
            $fabricante = isset($_POST['fabricante']) ? $_POST['fabricante'] : '';
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
            $serial = isset($_POST['serial']) ? $_POST['serial'] : '';
            $id_us = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';

            $insert =" UPDATE Roteador SET modelo = '" . addslashes($modelo) . "', descricao ='" . addslashes($descricao) . "', local = '" . addslashes($local) . "', serial = '" . addslashes($serial) . "', fabricante_id = '" . addslashes($fabricante) . "', status = '" . addslashes($status) . "' WHERE id = '" . addslashes($id_us) . "';"; 

            $insert .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Roteador",
		        "' .  $insert . '", 
		        "Roteador -> ' . addslashes($modelo) . ' MAC: ' . addslashes($serial) . '")';            

            mysqli_multi_query($conn, $insert);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
            unset($conn);
            include 'conexao.php';

            $foto = $_FILES['foto'];              
            $name_photo = $foto['name'];                
            $arquivos = $_FILES['foto'];

            $retorno = ['status' => 'success'];

            if($foto['name'] == ""){
                die(json_encode($retorno));
            } 
                    
            // Tamanho máximo do arquivo em bytes 
            $tamanho = 2097152;
                       
            if(!is_image_or_pdf($foto["type"]))
                {
                    $errors[] = "Isso não é uma imagem.";
                }
            elseif($foto["size"] > $tamanho)
                {
                    $errors[] = "A imagem pode ter no máximo ".$tamanho." bytes";
                }                                          
            
            if (count($errors) == 0) 
            {
                foreach($arquivos as $key => $imagem)
                {       
                    
                    if($key == 'name')
                    {
                        $nome_imagem = '';
                        $ext = [];

                        // Pega extensão da imagem
                        preg_match("/\.(gif|bmp|png|jpg|jpeg|pdf){1}$/i", $imagem, $ext);

                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];  

                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "assets/img/sistema/sfp/" .$id_us. '/' . $nome_imagem;
                            

                        $path = "assets/img/sistema/sfp/". $id_us;

                        if(!file_exists($path))
                        {
                            mkdir($path);                                                                        
                        }                

                        if(file_exists($path))
                        {
                            if(move_uploaded_file($arquivos['tmp_name'], $caminho_imagem))
                            {
                                $urlFile = 'assets/img/sistema/sfp/' . $id_us . '/' .utf8_encode($nome_imagem);

                                $sql_foto = "UPDATE Sfp SET foto = '".$urlFile."' WHERE id = {$id_us}";       

                                if($conn->query($sql_foto))
                                {
                                    $retorno = ['status' => 'success'];
                                }
                                else 
                                {
                                    $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                    die(json_encode($retorno));
                                }                        
                            }
                            else
                            {
                                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. Verifique e tente novamente.'];

                                die(json_encode($retorno));
                            }
                        }
                        else
                        {
                            $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem.'];

                            die(json_encode($retorno));                                    
                        }
                    }                        
                }
            }            
            else
            {     
                $retorno = ['status' => 'error', 'error' => 'Ops... Seu usuário foi atualizado corretamente, porém ocorreu um erro ao adicionar a sua imagem. O tamanho ou tipo da imagem eram inválidos.'];                                               
            }  
        }          

        die(json_encode($retorno));

        break;

        case 'dev-roteador':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome = mysqli_query($conn, "SELECT modelo, serial FROM Roteador WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);


            $dev = "UPDATE Roteador SET disponibilidade = 'D', Tecnico_id = NULL, Usuario_id = NULL, uptime = CURRENT_TIMESTAMP, data_inicio = NULL, data_fim = NULL, responsavel = NULL, descricao_evento = NULL, evento = NULL WHERE id = {$id_del};";

            $dev .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Roteador",
                "' .  $dev . '", 
                "Devolvido roteador -> ' . addslashes($nome_user['modelo']) . ' MAC '. addslashes($nome_user['serial']).'");';

            $dev .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Roteador", "D", "1")';

            mysqli_multi_query($conn, $dev);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        case 'ret-roteador':

            $val_id_tecnico = isset($_POST['val_id_tecnico']) ? $_POST['val_id_tecnico'] : '';
            $evento_ret = isset($_POST['evento_ret']) ? $_POST['evento_ret'] : '';
            $data_inicio_ret = isset($_POST['data_inicio_ret']) ? $_POST['data_inicio_ret'] : '';
            $data_fim_ret = isset($_POST['data_fim_ret']) ? $_POST['data_fim_ret'] : '';
            $resposavel_ret = isset($_POST['resposavel_ret']) ? $_POST['resposavel_ret'] : '';
            $descricao_ret = isset($_POST['descricao_ret']) ? $_POST['descricao_ret'] : '';
            $id_roteador_r = isset($_POST['id_roteador_r']) ? $_POST['id_roteador_r'] : '';
            $id_us = $_SESSION['idUsuario'];            

            $pega_nome = mysqli_query($conn, "SELECT nome FROM Roteador WHERE id= {$id_roteador_r}");
            $nome_user = mysqli_fetch_array($pega_nome);

            if ($val_id_tecnico == 'usuario') {
                $ret = "UPDATE Roteador SET disponibilidade = 'I', Tecnico_id = NULL, Usuario_id = '". addslashes($id_us) ."' , evento = '". addslashes($evento_ret) ."', data_inicio = '". addslashes($data_inicio_ret) ."', data_fim = '". addslashes($data_fim_ret) ."', responsavel = '". addslashes($resposavel_ret) ."', descricao_evento = '". addslashes($descricao_ret) ."' , uptime = CURRENT_TIMESTAMP WHERE id = {$id_roteador_r};";

                $ret .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Roteador",
                "' .  $ret . '", 
                "Retirado roteador ' . addslashes($nome_user['nome']) . ', pelo usuário ' . addslashes($_SESSION['usuario']) . '");';

                $ret .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Roteador", "R", "1")';

            }else{

                $pega_nome_tec = mysqli_query($conn, "SELECT nome FROM Tecnico WHERE id= {$val_id_tecnico}");
                $nome_tec = mysqli_fetch_array($pega_nome_tec);
                $ret = "UPDATE Roteador SET disponibilidade = 'I', Tecnico_id = '". addslashes($val_id_tecnico) ."', Usuario_id = '". addslashes($id_us) ."' , evento = '". addslashes($evento_ret) ."', data_inicio = '". addslashes($data_inicio_ret) ."', data_fim = '". addslashes($data_fim_ret) ."', responsavel = '". addslashes($resposavel_ret) ."', descricao_evento = '". addslashes($descricao_ret) ."' , uptime = CURRENT_TIMESTAMP WHERE id = {$id_roteador_r};";

                    $ret .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                        VALUES (' .$_SESSION['idUsuario'].  ', 
                        "Roteador",
                        "' .  $ret . '", 
                        "Retirado roteador ' . addslashes($nome_user['nome']) . ', pelo usuário ' . addslashes($_SESSION['usuario']) . ' e entregue para o técnico ' . addslashes($nome_tec['nome']) . '");';

                $ret .= 'INSERT INTO Dashboard ( tabela, acao, quantidade) VALUES ("Roteador", "R", "1")';

                } 

            mysqli_multi_query($conn, $ret);

            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;

        //EXCLUIR ALL ROUTERS

        case 'exc-all-roteador':

            $check = is_array($_POST['check']) ? implode(", ", $_POST['check']) : '';

            $pega_nome= mysqli_query($conn, "SELECT nome FROM Roteador WHERE id IN ({$check})");
            $conta = 0;

            while($nome_user = mysqli_fetch_array($pega_nome)){

                if ($conta >= 1) {
                    $nome_del = $nome_del .',  '. $nome_user['nome'];
                }else{
                   $nome_del = $nome_user['nome'];
                }
                $conta++;
            }

            $delete = "DELETE FROM `Roteador` WHERE id IN({$check});";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
		        VALUES (' .$_SESSION['idUsuario'].  ', 
		        "Roteador",
		        "' .  $delete . '", 
		        "Roteador com os seguintes nomes -> ' . $nome_del . '")';


            mysqli_multi_query($conn, $delete);


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }
              
            die(json_encode($retorno));
        break;

        case 'exc-unc-roteador':

            $id_del = isset($_POST['id']) ? $_POST['id'] : '';

            $pega_nome= mysqli_query($conn, "SELECT modelo, serial FROM Roteador WHERE id= {$id_del}");
            $nome_user = mysqli_fetch_array($pega_nome);

            $delete = "DELETE FROM `Roteador` WHERE id = {$id_del};";

            $delete .= 'INSERT INTO Historico ( usuario_id, tabela, query, descricao)
                VALUES (' .$_SESSION['idUsuario'].  ', 
                "Roteador",
                "' .  $delete . '", 
                "Roteador com o seguinte nome -> ' . addslashes($nome_user['nome']) . ' MAC: ' . addslashes($nome_user['serial']) . '")';


            mysqli_multi_query($conn, $delete);


            if($conn->error)
            {
                $retorno = ['status' => 'error', 'erro' => $conn->error];                   
            }
            else
            {
                $retorno = ['status' => 'success'];
            }

            die(json_encode($retorno));
            
        break;


        default:
            die("erro");
            echo 'Default';
        break;
    }
?>