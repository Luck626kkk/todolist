<!DOCTYPE html>
<?php include('data.php'); ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Todo List</title>
         <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
         <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
         <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
         <script src="handlebars-v4.0.11.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
         <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
       
        <style>
            .hide{
                display: none;
            }
            #panel {
                display: block;
                background-color: #eee;
                width: 600px;
                height: ul + 20px;
                margin: 0 auto;
                padding: 30px;
            }
            #list ul{
                margin: 0;
                padding: 0;
                list-style-type: none;
            }
            #list li.complete .checkbox{
                background-color: #000;
                
            }
            #list li:hover{
              background-color: #f8f8f8;
            }
            .checkbox{
                float: left;
                background-color: #777;
                width: 20px;
                height: 20px;
                 margin-right: 10px;
                border-radius: 50%;
                cursor: pointer;
            }
            .content{
                padding-top: 12px;
                float: left;
                width: calc(100% - 50px);
            }
            #list li.complete .content{
                text-decoration: line-through;
            }
            .action > *{
                float: left;
                padding-top: 12px;
                width: 20px;
                cursor: pointer;
            }

        </style>
    </head>
   
    <body>

        <script>
          
            $(document).ready(function () {

                var source = $("#todo-list-item-template").html();
                var todotemplate = Handlebars.compile(source);
                //create
                //$("li.new").find(".content").blur(function (e) {
                   
                    /*var li = $(".template").find("li").clone();
                    li.find(".content").text(todo);
                    //var li = $("<li></li>").text(todo);
                    $(e.currentTarget).closest('li').before(li);
                    $(e.currentTarget).empty();*/
                //});
                //editor
                $("#list").on("dblclick",".content",function(e){
                    $(this).prop("contenteditable",true).focus();
                });
                $("#list").on("blur",".content",function(e){
                    var isNew = $(this).closest("li").is(".new");
                    if(isNew){

                        var todo = $(e.currentTarget).text();
                        todo =todo.trim();

                        if(todo.length>0){

                            var orders = $("#list").find("li:not(.new)").length +1 ; //除了 new 之外的 li 
                            //AJAX: create API 簡化版
                            $.post("http://localhost:8080/todo/create.php", {content: todo, orders:orders},function(data,textStatus,xhr){
                                todo = {
                                    id: data.id,
                                    is_complete: false,
                                    content: todo
                                    //clearfix: clearfix
                            };
                            var li = todotemplate(todo);
                            $(e.currentTarget).closest("li").before(li);
                            });

                           /* $.ajax({
                                url:"".
                                type:"POST",
                                dataType:"json",
                                data:{todo: todo},
                                complete:function(xhr,textStatus){

                                },
                                success:function(data textStatus, xhr){

                                },
                                error:function(xhr, textStatus, errorThrown){

                                }
                            });*/
                           
                        }
                        $(e.currentTarget).empty();
                    }else{
                        $(this).prop("contenteditable",false);
                    }
                });
                $("#list").on("click",".delete",function(e){
                    var result = confirm("Do you want to delete?");
                    if(result){
                        $(this).closest("li").remove();
                    }
                });
                $("#list").on("click",".checkbox",function(e){
                    $(this).closest("li").toggleClass("complete");
                });
                $("#list").find("ul").sortable({
                    items: "li:not(.new)"
                });
            });
        </script>
        <div id="panel" style="padding-bottom: 50px;">
            <h1>Todo List</h1>
        
            <div id="list">
                <ul>
                    <?php foreach ($todos as $key => $todo): ?>
                    <li class="clearfix" data-id="<?=$todo['id']?>" >
                        <div class="checkbox"></div>
                        <div class="content"><?php echo $todo["content"] ?></div>
                        <div class="action">
                            <div class="delete">X</div>
                        </div>
                    </li>
                <?php endforeach ?>
                    <li class="clearfix">
                        <div class="checkbox"></div>
                        <div class="content">This is some text</div>
                        <div class="action">
                            <div class="delete">X</div>
                        </div>
                    </li>
                     <li class="clearfix complete">
                        <div class="checkbox"></div>
                        <div class="content">This is some text</div>
                        <div class="action">
                            <div class="delete">X</div>
                        </div>
                    </li>
                    <li class="new" class="clearfix">
                        <div class="checkbox" ></div>
                        <div class="content" contenteditable="true"></div>
                        
                    </li>
                </ul>
            </div>
         </div>

        <div class="template hide">
                <ul>
                <li class="clearfix">
                        <div class="checkbox"></div>
                        <div class="content"></div>
                        <div class="action">
                            <div class="delete">X</div>
                        </div>
                       
                </li>
                 </ul>
            </div>
       <script id="todo-list-item-template" type="text/x-handlebars-template">
          <li data-id="{{id}}" class="clearfix {{#if is_complete}}complete{{/if}}">
                      <div class="checkbox"></div>
                      <div class="content">{{content}}</div>
                      <div class="action">
                      <div class="delete">X</div>
                 </div>      
          </li>
       
        </script>

    </body>
</html>
