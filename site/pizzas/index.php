<?php include_once '../resources/componentes/header-nav.php'; ?>
<!-- datatables -->



<?php
$pizzas = $store->buscarPizzas();
$tipos = $store->buscarTipoPizza();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br/>
            <h1 class="title" style="display: inline">Pizzas</h1>&nbsp; &nbsp;
            <img style="padding-bottom:1%" id="icone-cesta" src="../public/img/icons/7cf2db5ec261a0fa27a502d3196a6f60.png"><br/>


            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../">Home</a></li>
                <li class="breadcrumb-item active">Pizzas</li>
            </ol>
            <hr/>
            <form id="frm-example" action="../cesta/addPizza.php" method="POST">
                <div id="tipos">
                    <h4 class="title" id="titulo">Escolha o tamanho da pizza</h4>
                    <?php foreach ($tipos as $tipo) { ?>
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="tipopizza" data-qtde="<?= $tipo['quantidade'] ?>" data-rjst="1.0<?= $tipo['reajuste'] ?>" value="<?= $tipo['idTipoPizza'] ?>"><?= $tipo['descricao'] ?><br/>
                    <?php } ?>
                        <h5>Quantidade</h5>
                    <div class="input-group" style="width: 100px;">
                        <span class="input-group-btn"><a onclick="DiminuiQuant()" class="btn btn-danger">-</a></span>
                        <input type="text" name="quantidade" id="quantidade" type="text" class="form-control" aria-label="Quantidade..." value="1" readonly style="width: 35px; text-align: center">
                        <span class="input-group-btn"><a onclick="AumentaQuant()" class="btn btn-danger">+</a></span>
                    </div>
                </div><br/>
                <p class="alert alert-danger"> 
                    *em pizzas com mais de 1 (um) sabor, será cobrado o valor maior;<br/>
                    **tamanhos diferentes têm valores diferentes;
               
                </p>

                <table id="example" class="table table-hover">
                    <thead>
                    <th>Selecione</th>
                    <th></th>
                    <th>nome</th>
                    <th>Valor (pizza inteira)</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pizzas as $pizza) {
                            ?>
                            <tr>
                                <td style="width: 20px"><input type="checkbox" value="<?= $pizza['idSabor'] ?>" name="sabor[]"></td>
                                <td>
                                    <a href="../public/img/<?= $pizza['imagem'] ?>" data-lightbox="nome">
                                        <img  id="img-pizza" src="../public/img/<?= $pizza['imagem'] ?>"/>
                                    </a>
                                </td>
                                <td>
                                    <h3><?= $pizza['nome'] ?></h3>
                                    <small><?= $pizza['descricao'] ?></small>
                                </td>
                                <td>
                                    <h5>R$&nbsp;<b class="valor"><?= $pizza['valor'] ?></b></h5>
                                    <input type="hidden" class="val" name="valor" value="<?=$pizza['valor']?>"/>
                                </td>

                            </tr>
                            
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
                

                <p><button class="btn btn-danger">Adicionar à cesta</button></p>


            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>
    function AumentaQuant() {
        var campo = document.getElementById("quantidade");
        if (parseInt(campo.value) < 5) {
            campo.value = parseInt(campo.value) + 1;
        }
    }
    function DiminuiQuant() {
        var campo = document.getElementById("quantidade");
        if (parseInt(campo.value) > 1) {
            campo.value = parseInt(campo.value) - 1;
        }
    }
    function qtdemaxima()
    {
        return $("input[name='tipopizza']:checked").attr('data-qtde');
    }

    
    function reajuste() {
        var rjst = parseFloat($("input[name='tipopizza']:checked").attr('data-rjst'));
        var i;
      //  for (i = 0; i < $('.valor').length; i++) {
         //   $('.valor')[i].innerText = (parseFloat($('.val')[i].val()) * rjst).toFixed(2);
        //}
        
        $('#example tbody tr').each(function(){  
            $('.valor', this).text((parseFloat($('.val', this).val()) * rjst).toFixed(2));
        })
    }
   
    $(document).ready(function () {
        var rows_selected = [];
        $("input[name='tipopizza']")[0].checked = true;
        reajuste();
        $('#tipos').on('click', 'input[type="radio"]', function (e) {
            $('#example tbody input[type="checkbox"]').prop('checked', false);
            $('#example tbody input[type="checkbox"]').prop("disabled", false);
            $('#example tbody input[type="checkbox"]').closest('tr').removeClass('selected');
            rows_selected = [];

            reajuste();


        });

        var table = $('#example').DataTable({
            'language': {
                'search': "Pesquisar"
            },
            'scrollY': "600px",
            'scrollCollapse': true,
            'paging': false
                    //'ordering': false,
        });
        // Handle click on checkbox
        $('#example tbody').on('click', 'input[type="checkbox"]', function (e) {
            var $row = $(this).closest('tr');

            // Get row ID
            var rowId = this.value;

            // Determine whether row ID is in the list of selected row IDs 
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);
                $row.addClass('selected');
                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
                $row.removeClass('selected');
            }

            // Solução do Professor
            if (rows_selected.length == qtdemaxima()) {
                $('#example tbody input[type="checkbox"]:not(:checked)').prop("disabled", true);
            } else {
                $('#example tbody input[type="checkbox"]').prop("disabled", false);
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle form submission event 
        $('#frm-example').on('submit', function (e) {
            if (rows_selected.length === 0 || rows_selected.length < qtdemaxima()) {
                alert("Selecione a quantidade de sabores correspondente!");
                e.preventDefault();
            }
        });
    });
    //]]>
</script>
<?php include '../resources/componentes/footer.php'; ?>

