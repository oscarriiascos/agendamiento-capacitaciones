const validate = () => {

    event.preventDefault()

    let isValid = true;
    let inputsWithError = []

    const validableInputs = [ 'course_name', 'avaliable_quotas', 'schedule' ]                

    validableInputs.map(inputName => {

        let validatedInputValue = document.querySelector(`input[id='${inputName}']`)
        let validatedInputName = document.querySelector(`input[id='${inputName}']`).getAttribute('alt-name')

        if ( validatedInputValue.value.trim().length === 0 ) {
            inputsWithError.push(validatedInputName) 
            validatedInputValue.classList.add(`border-2`, `border-rose-400`)
        }

    });
    
    //Lanzamos alert con los errores
    if ( inputsWithError.length > 0 ) {

        Swal.fire({
            title: `¡Ups!`,
            text: `Hay un error en el formulario verifica lo siguiente: ${inputsWithError.join()}`,
            confirmButtonText: `Volver para corregir`
        })  

        isValid = false

        //Interrumpe el resto de la ejecución
        return
    }

    //Revisión del calendario
    const classDate = document.querySelector('#schedule')
    const formatedDate = new Date(classDate.value)

    const isvalidTime = (formatedDate.getHours() >= 10)  && (formatedDate.getHours() < 23)
    const isvalidWeekDay = (formatedDate.getDay() >= 1 ) && (formatedDate.getDay() <= 5)

    const currentDate = new Date();
    
    //Verifica que pueda programar en el horario y día indicados
    if ( !isvalidTime || !isvalidWeekDay || formatedDate < currentDate ) {
        
        classDate.classList.add(`border-2`, `border-rose-400`)
        
        Swal.fire({
            title: `Tienes un error`,
            text: `El horario establecido no es permitido`,
            confirmButtonText: 'Volver para corregir'
        })
        
        isValid = false
    }
    
    //Si todas las validaciones salieron bien, se puede enviar el formulario
    if (isValid) {
       
        let timerInterval
        
        Swal.fire({
            title: 'Guardando programación',
            html: 'Por favor espera un momento.',
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => {}, 3000)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then( () => {
            document.querySelector('form[name="course"]').submit()
        })

    }
}
