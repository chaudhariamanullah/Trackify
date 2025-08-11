function addTask() {

    let task = document.querySelector("#task-text");
    let todo = document.querySelector("#todo-board");

    task.style.display = "flex";

    todo.classList.add("blur")
}

function removeTaskDiv(){
    let task = document.querySelector("#task-text");
    let todo = document.querySelector("#todo-board");

    task.style.display = "none";
    todo.classList.remove("blur")
}

function editTask(taskNo,task_id){

    let editDiv = document.querySelector("#edit-task");
    let todo = document.querySelector("#todo-board");

    todo.classList.add("blur");

    editDiv.style.display = "flex";

    let taskNames = document.querySelectorAll(".task");
    let taskDiv = null;

    taskNames.forEach(task => {
        if ( task.querySelector(".sr-no").innerText.trim() == taskNo)
            taskDiv = task;
    });

    if ( taskDiv ){
        editDiv.querySelector("input").value = taskDiv.querySelector(".task-name").innerText;
        editDiv.querySelector("select").value = taskDiv.querySelector(".priority").innerText.toLowerCase();
        let hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "task_id";
        hiddenInput.value = task_id;
        editDiv.querySelector("form").appendChild(hiddenInput);
    }
}

function removeEditDiv(){
    let task = document.querySelector("#edit-task");
    let todo = document.querySelector("#todo-board");

    task.style.display = "none";
    todo.classList.remove("blur")
}


function showTools(srno){
    let taskDivs = document.querySelectorAll(".task");

    taskDivs.forEach( taskDiv =>{
        tempSrno =  taskDiv.querySelector(".sr-no").innerText;

        if ( tempSrno == srno){
            taskDiv.classList.toggle("mobile-task");

            const div = document.createElement('div');
            div.innerText = taskDiv.querySelector('.priority').innerText;
            div.classList.add('priority', 'mobile-priority');

            if (  div.innerText == 'Low'){
                div.classList.add('low-priority');
            } else if ( div.innerText == 'Mid' ){
                div.classList.add('mid-priority');
            } else {
                div.classList.add('high-priority');
            }

            const existingDiv = taskDiv.querySelector('.priority.mobile-priority');

            
            if (existingDiv) {
                taskDiv.querySelector(".tool-btns").removeChild(existingDiv);
            } else {
                div.style.width = 'auto';
                div.style.padding = '0.2rem'
                taskDiv.querySelector(".tool-btns").appendChild(div);
            }

            taskDiv.querySelector(".tool-btns").classList.toggle("mobile-tools-btn");
        }
    })
}

function validateInput(){
    let chars = document.querySelector('.inputTask').value;

    if ( chars.trim().length >= 3)
        document.querySelector('.inputBtnSet').disabled = false;
}