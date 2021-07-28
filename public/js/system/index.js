$(function(){
    let ram = {};
    let console = false
    let cli_position = 0;
    $(document).ready(function(){
        $(document).on('click','.btn-cli,.icon_terminal',function(){
            $(".cli-body").fadeIn(500)
            $(".cli-body").css("z-index","100")
                $("#cli-value").focus()
                cli_position = $('.command.active').position()["top"];
                $("#cli-value").css("top",cli_position+"px")
                console = true
        })
        $('.cli-body').on("click",function(){
            $("#cli-value").focus()
            cli_position = $('.command.active').position()["top"];
            $("#cli-value").css("top",cli_position+"px")
        })
        $("#cli-value").on('keyup',function(event){
            $('.cmd_val').html($(this).val())
            let elt = $(this)
            let graphical_mode = false;
            let keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.cmd_val_r').removeClass('cmd_val')
                $('.command').removeClass("active")
                let cmd = '<li class="command active"><span class="cli_user">root@equipe-rd$</span><span class="cmd_val_r cmd_val"></span></li>';
                let cmdline = elt.val()
                if(cmdline !== undefined){
                    if(cmdline.trim() == "clear"){
                        $('.command-list').html("")
                        $('.command-list').append(cmd)
                        elt.val("")
                        cli_position = $('.command.active').position()["top"];
                        $("#cli-value").css("top",cli_position+"px")
                        return false
                    }
                    if(cmdline.trim() == "exit"){
                        $('.command-list').html("")
                        $('.command-list').append(cmd)
                        elt.val("")
                        $(".cli-body").css("z-index","0")
                        cli_position = $('.command.active').position()["top"];
                        $("#cli-value").css("top",cli_position+"px")
                        return false
                    }
                }
                $('.command-list').append('<li class="cli-chargement"><div class="bc-loader" style="display:flex"><div class="loader"></div>&nbsp;&nbsp;Chargement...</div></li>')
                $.ajax({
                    type: 'POST',
                    url: 'views/system/system.php',
                    data: "action=cli&c="+elt.val(),
                    success: function(retour)
                    {
                        let fenetre;
                        if(retour.search("x55") > 0){
                            graphical_mode = true;
                            $('.fenetre').css('z-index',"5");
                            if(cmdline.search("migration_php7") >= 0){
                                $(".cli-body").css("z-index","0")
                                fenetre = new Fenetre("MAX","MAX","",true);
                            }
                            else{
                                $(".cli-body").css("z-index","0")
                                fenetre = new Fenetre(800,"","");
                            }
                            fenetre.print(retour);
                            focus_fenentre = true;
                        }
                        retour = retour.replaceAll('\n','<br>');
                        retour = retour.replaceAll('\r','');
                        $('.cli-chargement').remove();
                        if(!graphical_mode){ 
                            $('.command-list').append('<li class="cli-result">'+retour+'</li>'+cmd)
                        }
                        else{
                            $('.command-list').append(cmd)
                        }
                        elt.val("")
                        cli_position = $('.command.active').position()["top"];
                        $("#cli-value").css("top",cli_position+"px")
                        //$(".cli-body").scrollTop(10000)
                    },
                    error: function(){
                        $('.command-list').append('<li class="cli-result">An Error occured</li>'+cmd)
                    }
                })
            }
        })
        $(".icon_terminal").click()
        /** Application migration_php7 */
        domaine = $("#domaine").val()
        $(document).on('click','.home',function(){
            tab["Run"] = historique;
            echo(tab["home"])
        })
        $(document).on('click','.btn-command',function(){
            let target = $(this).attr("data-target").trim()
            let retour = tab[target]
            let file = ""
            let action = ""
            if(target == "Run"){
                file = "script.php"
            }
            else if(target == "Filtrer"){
                file = "ajax_php7cc.php"
                action = "&action=filtrer"
                tab["Run"] = historique;
            }
            if(tab[target] == "" || tab[target] == null){
                echo("<div style='display:flex'><div class='loader'></div>&nbsp;&nbsp;Chargement...</div>")
                $.ajax({
                    type: 'POST',
                    url: file,
                    data: "d="+domaine+action,
                    success: function(retour)
                    {
                        tab[target] = '<table class="table" style="width: 2000px;"><tbody>'+retour+'</tbody></table><table>';
                        echo (tab[target])
                        if(target == "Run"){
                            historique = tab[target]
                        }
                    }
                })
            }
            else{
                echo(tab[target])
            }
        })
    })
})