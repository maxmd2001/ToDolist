'use strict';


// send task to php by ajax
class Sanitize{
    sanitizeText(string) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#x27;',
            "/": '&#x2F;',
        };
        const reg = /[&<>"'/]/ig;
        return string.replace(reg, (match)=>(map[match]));
    }
}

let sanitize = new Sanitize();

$( document ).ready( function() {
    

    // add task start
    $('#taskSubmitInput').click( function(e) {
        e.preventDefault();

        const taskName = sanitize.sanitizeText($('#taskText').val());

        // check the value is not empty
        if (taskName) {

            $.ajax({
                type: "POST",
                url: "inc/ajax.php",
                data: {taskName : taskName},

                success: function (newTaskId) {
                    console.log(newTaskId);
                    newTaskId = Number(newTaskId);

                    // making a new task without refresh the page
                    // tasks container
                    let tasksContainer = document.getElementById('tasks');
                    // div container fot task
                    let divTask = document.createElement('div');
                    divTask.setAttribute('class', 'task');
                    divTask.setAttribute('taskId', newTaskId);
                    
                    // checkBox
                    let inputCheck = document.createElement('input');
                    inputCheck.setAttribute('type', 'checkbox');
                    inputCheck.setAttribute('name', 'taskCheck');
                    inputCheck.setAttribute('class', 'checkTasksToggle');

                    
                    // text
                    let pText = document.createElement('p');
                    pText.innerHTML = taskName;
                    
                    
                    // remove Task
                    let removeTask = document.createElement('button');
                    removeTask.innerText = 'x';
                    removeTask.setAttribute('class', 'removeTask');

                    // removeTask.addEventListener('click', removeTasks);
                    
                    
                    // add them inside divTask(parent)
                    divTask.append(inputCheck);
                    divTask.append(pText);
                    divTask.append(removeTask);

                    // add them to tasks
                    tasksContainer.prepend(divTask);

                    // remove the text from text input
                    $('#taskText').val('');
                }
            });
        }

    })
    // add task end




    // remove Task Start

    $(document).on('click', '.removeTask',function (e) {
        const taskId = $(e.target.parentElement).attr('taskId');

        $.ajax({
            type: "POST",
            url: "inc/ajax.php",
            data: {taskIdForRemove : taskId},
            success: function (response) {
                $(e.target.parentElement).remove();
            }
        });

    });

    function removeTasks(e) { 

     }

    
     $('.removeTask').click(function (e) { 
         e.preventDefault();
        removeTasks(e);
      });
      
      // remove Task End
      
      
      // task check start

       $(document).on('click', '.checkTasksToggle',function (e) {
        console.log('meoww');
        const taskId = $(e.target.parentElement).attr('taskId');
        console.log(e.target.checked)   ;
            $.ajax({
                type: "POST",
                url: "inc/ajax.php",
                data: {taskIdToggleComplete : taskId},
                success: function (response) {
                // make the task opaicty 0.5
                let parent = e.target.parentElement;

                // take a copy from the task
                $(parent).toggleClass('opacity5');

                $(e.target.parentElement).remove();

                // remove and add task at bottom if it is complete 
                if (e.target.checked == true) {
                    
                    $('#tasks').append(parent);
                    console.log(parent)
                }
                // put the the at top if the user unchecked the task
                else{
                    $('#tasks').prepend(parent);
                    console.log(parent)

                }
            }
          });
        
       });
      

    // task check End


});


