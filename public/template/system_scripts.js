

//AGENT
function confirmAgentDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.agent-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.agent-leave-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.agent-list-IT-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });


  document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("agentlist_agent_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, ''); // Remove spaces

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

//CPU


function cpuaddprocessor(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom processor:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function cpuaddRam(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom RAM:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function cpuaddstorage(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom storage:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}


function cpuEditRam(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom RAM:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function cpuEditProcessor(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom CPU:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function cpuEditStorage(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom Storage:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function cpuEditCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function cpuAddCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}


document.addEventListener('DOMContentLoaded', function() {
var cells = document.querySelectorAll('.cpu-cell-clickable');

cells.forEach(function(cell) {
  cell.addEventListener('click', function() {
    var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
    if (editButton) {
      editButton.click();
    }
  });
});
});


// $(document).ready(function() {
//     $('.cpu_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.cpu_agent_fk_id').val("");
//             $('.capu_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.cpu_agent_fk_id').val(agentId);
//             $('.capu_agent_name').val(agentName);
//         }
//     });

//     function cpuEditStatus(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.cpu_agent_fk_id');
//         var agentInput = $('.capu_agent_name');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#status').change(function() {
//         cpuEditStatus(this);
//     });
// });


document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("cpu_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

function confirmCPUDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//HEADSET
// function headsetEditStatus(selectElement) {
//     var selectedValue = selectElement.value;
//     if (selectedValue === "") {
//         var newValue = prompt("Enter custom status:");
//         if (newValue !== null) {
//             var newOption = document.createElement("option");
//             newOption.value = newValue;
//             newOption.text = newValue;
//             selectElement.add(newOption);
//             selectElement.value = newValue;
//         } 
//     }
// }

function editconditionheadset(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function addHeadsetCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
document.addEventListener('DOMContentLoaded', function() {
var cells = document.querySelectorAll('.headset_cell-clickable');

cells.forEach(function(cell) {
  cell.addEventListener('click', function() {
    var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
    if (editButton) {
      editButton.click();
    }
  });
});
});

// $(document).ready(function() {
//     $('.headset_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.headset_agent_fk_id').val("");
//             $('.headset_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.headset_agent_fk_id').val(agentId);
//             $('.headset_agent_name').val(agentName);
//         }
//     });

//     function headsetEditStatus(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.headset_agent_fk_id');
//         var agentInput = $('.headset_agent_name');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#status').change(function() {
//         headsetEditStatus(this);
//     });
// });



document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("headset_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

function confirmHeadsetDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//MOUSE
function mousestatusedit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function mousecondtionedit(selectElement) {
  var selectedValue = selectElement.value;
  if (selectedValue === "") {
      var newValue = prompt("Enter custom condition:");
      if (newValue !== null) {
          var newOption = document.createElement("option");
          newOption.value = newValue;
          newOption.text = newValue;
          selectElement.add(newOption);
          selectElement.value = newValue;
      } 
  }
}
function conditioneditmouse(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

// $(document).ready(function() {
//     $('.mouse_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.mouse_agent_fk_id').val("");
//             $('.mouse_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.mouse_agent_fk_id').val(agentId);
//             $('.mouse_agent_name').val(agentName);
//         }
//     });

//     function mousestatusedit(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.mouse_agent_fk_id');
//         var agentInput = $('.mouse_agent_name');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#status').change(function() {
//         mousestatusedit(this);
//     });
// });





document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.mouse_cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("mouse_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

function confirmMouseDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//KEYBOARD
// function keyboardstatusedit(selectElement) {
//     var selectedValue = selectElement.value;
//     if (selectedValue === "") {
//         var newValue = prompt("Enter custom status:");
//         if (newValue !== null) {
//             var newOption = document.createElement("option");
//             newOption.value = newValue;
//             newOption.text = newValue;
//             selectElement.add(newOption);
//             selectElement.value = newValue;
//         } 
//     }
// }
function keyboardcondtionedit(selectElement) {
  var selectedValue = selectElement.value;
  if (selectedValue === "") {
      var newValue = prompt("Enter custom condition:");
      if (newValue !== null) {
          var newOption = document.createElement("option");
          newOption.value = newValue;
          newOption.text = newValue;
          selectElement.add(newOption);
          selectElement.value = newValue;
      } 
  }
}

function AddKeyboardCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

// $(document).ready(function() {
//     $('.keyboard_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.keyboard_agent_fk_id').val("");
//             $('.keyboard_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.keyboard_agent_fk_id').val(agentId);
//             $('.keyboard_agent_name').val(agentName);
//         }
//     });

//     function keyboardstatusedit(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.keyboard_agent_fk_id');
//         var agentInput = $('.keyboard_agent_name');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#keyboard_status').change(function() {
//         keyboardstatusedit(this);
//     });
// });



document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.keyboard_cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("keyboard_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

function confirmKeyboardDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//MONITOR
function addmonitorcondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}


function monitorStatusEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function monitorConditionEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.monitor-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("monitor_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

function confirmMonitorDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//AGENT MONITOR
document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.agent-monitor-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });
//   $(document).ready(function() {
//     $('.firstmonitor_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text(); 
//         var formId = $(this).data('id');
//         $('#agent_id_display-' + formId).text(agentId);
//         $('.addmonitor_one_fk').val(agentId);
//         $('.addmonitor_one').val(agentName); 
//     });
// });

// $(document).ready(function() {
//     $('.second_monitor_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text(); 
//         var formId = $(this).data('id');
//         $('#agent_id_display-' + formId).text(agentId);
//         $('.addmonitor_two_fk').val(agentId);
//         $('.addmonitor_two').val(agentName); 
//     });
// });



// $(document).ready(function() {
// $('.edit_firstmonitor_dropdown').change(function() {
//     var agentId = $(this).val();
//     var agentName = $(this).find('option:selected').text(); 
//     var formId = $(this).data('id');

//     if (agentId === "") {
//         $('.monitor_one_fk').val("");
//         $('.monitor_one').val(""); 
//     } else {
//         $('#agent_id_display-' + formId).text(agentId);
//         $('.monitor_one_fk').val(agentId);
//         $('.monitor_one').val(agentName);
//     }
// });
// });
// $(document).ready(function() {
//     $('.edit_second_monitor_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text(); 
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.monitor_two_fk').val("");
//             $('.monitor_two').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.monitor_two_fk').val(agentId);
//             $('.monitor_two').val(agentName);
//         }
//     });
// });
// $(document).ready(function() {
//     $('.agent_monitor_agentedit_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text(); 
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.monitor_agent_edit_agent_fk_id').val("");
//             $('.monitor_agent_edit_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.monitor_agent_edit_agent_fk_id').val(agentId);
//             $('.monitor_agent_edit_agent_name').val(agentName);
//         }
//     });
// });



// $(document).ready(function() {
//     $('.monitor_agentadd_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text(); 
//         var formId = $(this).data('id');
    
//         if (agentId === "") {
//             $('.monitor_agent_add_agent_fk_id').val("");
//             $('.monitor_agent_add_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.monitor_agent_add_agent_fk_id').val(agentId);
//             $('.monitor_agent_add_agent_name').val(agentName);
//         }
//     });
// });

function confirmAgentMonitorDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}


//PHONE
function addPhoneCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
// function editPhoneStatus(selectElement) {
//     var selectedValue = selectElement.value;
//     if (selectedValue === "") {
//         var newValue = prompt("Enter custom status:");
//         if (newValue !== null) {
//             var newOption = document.createElement("option");
//             newOption.value = newValue;
//             newOption.text = newValue;
//             selectElement.add(newOption);
//             selectElement.value = newValue;
//         } 
//     }
// }

function editphoneConditionOne(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function editphoneConditionTwo(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function editphoneConditionThree(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function editConditionPhone(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.phone-cell-clickable');

    cells.forEach(function(cell) {
        cell.addEventListener('click', function() {
            var targetModalId = this.getAttribute('data-target');
            var targetModal = document.querySelector(targetModalId);
            if (targetModal) {
                $(targetModal).modal('show');
            }
        });
    });
});

// $(document).ready(function() {
//     $('.phone_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.phone_agent_fk_id').val("");
//             $('.phone_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.phone_agent_fk_id').val(agentId);
//             $('.phone_agent_name').val(agentName);
//         }
//     });

//     function editPhoneStatus(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.phone_agent_fk_id');
//         var agentInput = $('.phone_agent_name');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#phone_status').change(function() {
//         editPhoneStatus(this);
//     });
// });


function confirmPhoneDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("phone_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

//SGSIMCARD
function editUsedInSGsimcard(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom Used in:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
$(document).ready(function() {
    $('#simcard_agent_dropdown').change(function() {
        var agentId = $(this).val();
        var agentName = $(this).find('option:selected').text(); 

        if (agentId === "") {
            $('#agent_fk_id').val("");
            $('#phone_agent_name').val(""); 
        } else {
            $('#agent_fk_id').val(agentId);
            $('#phone_agent_name').val(agentName);
        }
    });
});

$(document).ready(function() {
    $('.edit_simcard_agentdropdown').change(function() {
        var agentId = $(this).val();
        var agentName = $(this).find('option:selected').text(); 
        var formId = $(this).data('id');

        if (agentId === "") {
            $('.edit_agent_fk_id').val("");
            $('.edit_agent').val(""); 
        } else {
            $('#agent_id_display-' + formId).text(agentId);
            $('.edit_agent_fk_id').val(agentId);
            $('.edit_agent').val(agentName);
        }
    });
});










document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.sgsimcard_cell-clickable');
    
    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
    });

//LAPTOP

function laptopcConditionAdd(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function laptopCPUadd(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom processor:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function laptopRAMadd(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom RAM:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function laptopStorageAdd(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom storage:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}


// function laptopStatusEdit(selectElement) {
//     var selectedValue = selectElement.value;
//     if (selectedValue === "") {
//         var newValue = prompt("Enter custom status:");
//         if (newValue !== null) {
//             var newOption = document.createElement("option");
//             newOption.value = newValue;
//             newOption.text = newValue;
//             selectElement.add(newOption);
//             selectElement.value = newValue;
//         } 
//     }
// }
  
function laptopRamEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom RAM:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function laptopCpuEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom CPU:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function laptopStorageEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom storage:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function laptopConditionEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.laptop-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

//   $(document).ready(function() {
//     $('.laptop_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.laptop_agent_fk_id').val("");
//             $('.laptop_agent').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.laptop_agent_fk_id').val(agentId);
//             $('.laptop_agent').val(agentName);
//         }
//     });

//     function laptopStatusEdit(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.laptop_agent_fk_id');
//         var agentInput = $('.laptop_agent');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#laptop_status').change(function() {
//         laptopStatusEdit(this);
//     });
// });
  

function confirmLaptopDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("laptop_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

//WEBCAM

document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("webcam_equip_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

function webcamStatusEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function webcamConditionEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
function webcamAddCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('.webcam-cell-clickable');

    cells.forEach(function(cell) {
      cell.addEventListener('click', function() {
        var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
        if (editButton) {
          editButton.click();
        }
      });
    });
  });

//   $(document).ready(function() {
//     $('.webcam_agent_dropdown').change(function() {
//         var agentId = $(this).val();
//         var agentName = $(this).find('option:selected').text();
//         var formId = $(this).data('id');

//         if (agentId === "") {
//             $('.webcam_agent_fk_id').val("");
//             $('.webcam_agent_name').val(""); 
//         } else {
//             $('#agent_id_display-' + formId).text(agentId);
//             $('.webcam_agent_fk_id').val(agentId);
//             $('.webcam_agent_name').val(agentName);
//         }
//     });

//     function webcamStatusEdit(selectElement) {
//         var status = selectElement.value;
//         var agentFkIdInput = $('.webcam_agent_fk_id');
//         var agentInput = $('.webcam_agent_name');

//         if (status !== 'Assigned' && status !== 'Unassigned') {
//             agentFkIdInput.val(""); // Set agent_fk_id to empty
//             agentInput.val(""); // Set agent to empty
//         }
//     }
//     $('.form-control#webcam_status').change(function() {
//         webcamStatusEdit(this);
//     });
// });
 


function confirmWebcamDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//LOCKER
document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("locker_tool_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("locker_no");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var lockerNumberInputs = document.querySelectorAll('.locker-number');

    lockerNumberInputs.forEach(function(input) {
        input.addEventListener("input", function(event) {
            var inputValue = event.target.value;
            var newValue = inputValue.replace(/\s/g, '');

            if (inputValue !== newValue) {
                event.target.value = newValue;
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("locker_no");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, '');

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});
function lockerAddCondition(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}




function lockerStatusEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

function lockerConditionEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom condition:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }
}

document.addEventListener('DOMContentLoaded', function() {
var cells = document.querySelectorAll('.locker-cell-clickable');

cells.forEach(function(cell) {
  cell.addEventListener('click', function() {
    var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
    if (editButton) {
      editButton.click();
    }
  });
});
});



function confirmLockerDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

//ACCOUNTABILITY 

function printMainPanel() {
    window.print();
}
document.getElementById('printButton').addEventListener('click', function() {
    printMainPanel();
});









  




   