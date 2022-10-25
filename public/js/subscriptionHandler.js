const updateSubscription = (courseId) => {

    fetch('api/course/subscription',{
        method: 'post',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 'course_id': courseId })
    })
    .then( response => response.json() )
    .then( ( hasUpdated ) => {

        let timerInterval

        if ( hasUpdated ) {
            Swal.fire({
                title: 'Inscripción exitosa',
                html: 'Puedes cancelar tus inscripción en cualquier momento.',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {}, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then( () => {
                location.reload()   
            })
                        
        }else{
            Swal.fire({
                title: 'Inscripción cancelada',
                html: 'Puedes volver a inscribirte en cualquier momento.',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {}, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then( () => {
                location.reload()   
            })
        }
    })
    
}