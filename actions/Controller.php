<?php

    require "C://xampp\htdocs\Projetos\lista-e\actions\Model.php";
    require "C://xampp\htdocs\Projetos\lista-e\actions\Service.php";
    require "C://xampp\htdocs\Projetos\lista-e\actions\Connection.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == "inserir"){

        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: ../pages/new_task.php?inclusao=1');   

    }else if($acao == "recuperar"){
        
        $conexao = new Conexao();
        $tarefa = new Tarefa();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();

    }else if($acao == "atualizar"){

        $tarefa = new Tarefa();
        $tarefa->__set("id", $_POST['id'])->__set("tarefa", $_POST['tarefa']);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);

        if($tarefaService->atualizar()){
            if($_GET['page'] == "index"){
                header("Location: ../index.php?mudanca=1");
            }else{
                header("Location: ../pages/all_task.php?mudanca=1");
            }
            
        }

    }else if($acao == "remover"){

        $conexao = new Conexao();
        $tarefa = new Tarefa();

        $tarefa->__set("id", $_GET['id']);

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if($_GET['page'] == "index"){
            header("Location: ../index.php?mudanca=2");
        }
        else{
            header("Location: ../pages/all_task.php?mudanca=2");
        }

    }else if($acao == "marcarRealizada"){

        $tarefa = new Tarefa();
        $tarefa->__set("id", $_GET['id'])->__set("id_status", 2);

        $conexao = new Conexao();
        $tarefaService = new tarefaService($conexao, $tarefa);

        $tarefaService->marcarRealizada();

        if($_GET['page'] == "index"){
            header("Location: ../index.php");
        }
        else{
            header("Location: ../pages/all_task.php");
        }
    }

?>