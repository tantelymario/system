class Fenetre {
    constructor(width,height="",theme="",notitle=false){
        let d = new Date();
        let height_value = "";
        if(theme == ""){
            this.theme = "#fff";
        }
        else{
            this.theme = theme
        }
        if(notitle){
            $(".screen").css("padding","0px")
        }
        this.id = "fen-"+d.getTime();
        this.width = width;
        this.height = height;
        this.title_bar = notitle;
        let screen_now = $(".screen").html();
        if(height!="")
        {
            if(this.height == "MAX"){
                height_value = "100%";
            }
            else{
                height_value = `${this.height}px`;
            }
        }
        $(".screen").html(this.contenu()+screen_now);
        let elt = $(`#${this.id}`);
        elt.css({
            "position":"fixed",
            "width":(this.width == "MAX")?"100%":`${this.width}px`,
            "height":height_value,
            "box-shadow":"0px 0px 7px #555",
            "z-index":"100",
            "color":"#000",
            "background-color":"#fff"
        });
        elt.find('.title-bar').css({
            "background-color":this.theme,
            "text-align":"right"
        })
        $('#'+this.id+' .title-bar .fenetre-close').on('click',function(){
            elt.remove();
            $(".screen").css("padding","0px")
        })
    }
    getId(){
        return this.id;
    }
    getWidth(){
        return this.getWidth();
    }
    getHeight(){
        return this.getHeight();
    }
    getCursorXY(e) {
        document.getElementById('cursorX').value = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
        document.getElementById('cursorY').value = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
    }
    contenu(){
        if(!this.title_bar){
            return `
                <div class="fenetre" id="${this.id}">
                    <div class="title-bar">
                        <div class="btn fenetre-btn fenetre-reduce">_</div>
                        <div class="btn fenetre-btn fenetre-max">[]</div>
                        <div class="btn fenetre-btn fenetre-close">X</div>
                    </div>
                    <div class="fenetre-content">
                    </div>
                </div>
            `;
        }
        else{
            return `
                <div class="fenetre" id="${this.id}">
                    <div class="fenetre-content">
                    </div>
                </div>
            `;
        }
    }
    print(contenu){
        $(`#${this.id} .fenetre-content`).html(contenu);
    }
    maximize(){
        $('#'+this.id).css({"width":"100%","height":"100%"});
    }
    fermer(){
        $('#'+this.id).remove();
    }
}