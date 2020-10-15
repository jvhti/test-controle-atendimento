<span class="badge {{employeeBadger($employee, $dayOfWeek)}}" data-placement="auto" data-toggle="tooltip"
      title="{{ days()[$dayOfWeek]  }}: {{employeeWorksOnDay($employee, $dayOfWeek) ? "Sim" : "Não"}}">{{ ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'][$dayOfWeek] }}</span>
