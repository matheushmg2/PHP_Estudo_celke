<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="d-flex">
    <nav class="sidebar">
        <ul class="list-unstyled">
            <?php
            $cont_drop_menu = 0;
            $cont_drop_fech = 0;
                foreach ($this->Dados['menu'] as $menu) {
                    extract($menu);
                    if($dropdown == 1){ // Parte do Menu Dropdown - Fazendo um sub_menu Recursivo/Dinamico
                        if($cont_drop_menu != $id_menu){
                            if($cont_drop_fech == 1 && $cont_drop_menu != 0){
                                echo "    </ul>"; // Finalizando a ul do sub_menu/dropdown
                                echo "</li>"; // Finalizando a li do menu para acionar o sub_menu/dropdown
                                $cont_drop_fech = 0;
                            }
                            echo "<li>"; // li do menu para acionar o sub_menu/dropdown
                            echo "    <a href='#sub".$id_menu."' data-toggle='collapse'>";
                            echo "        <i class='".$icone_menu."'></i> ".$nome_menu;
                            echo "    </a>";
                            echo "    <ul id='sub".$id_menu."' class='list-unstyled collapse'>"; // Inicio da ul - sub_menu/dropdown
                            $cont_drop_menu = $id_menu;
                        }
                        
                        echo "        <li><a href='".URLADM.$menu_controller."/".$menu_metodo."'><i class='".$icones_subMenu."'></i> ".$nome_pg."</a></li>"; // li dentro do sub_menu/dropdown
                        $cont_drop_fech = 1;
                    } else {
                        if($cont_drop_fech == 1){
                            echo "    </ul>"; // Finalizando a ul do sub_menu/dropdown
                            echo "</li>"; // Finalizando a li do menu para acionar o sub_menu/dropdown
                            $cont_drop_fech = 0;
                        }
                        echo "<li><a href='".URLADM.$menu_controller."/".$menu_metodo."'><i class='".$icone_menu."'></i> ".$nome_menu."</a></li>"; // li comum sem sub_menu/dropdown
                    }
                }
                if($cont_drop_fech == 1){
                    echo "    </ul>";
                    echo "</li>";
                    $cont_drop_fech = 0;
                }
            ?>
        </ul>
    </nav>