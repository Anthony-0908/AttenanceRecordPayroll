//Summing the time 

SELECT SUM(hours) emp_id FROM attendance WHERE emp_id = 'GH101'



SELECT  SUM(hours) AS total_hrs, SUM(hrs_worked) AS overtime_hrs, attendance.emp_id,  attendance.full_name, employee_tbl.Position,employee_tbl.Emp_id AS emp_id FROM attendance LEFT JOIN employee_tbl ON employee_tbl.Emp_id = attendance.emp_id
 LEFT JOIN overtime ON  overtime.emp_id = attendance.emp_id
WHERE attendance.emp_id = 'GH101'



SELECT SUM(overtime.hrs_worked) AS overtime_hrs, SUM(attendance.hours) AS hours_worked, attendance.emp_id , employee_tbl.Position, attendance.full_name, attendance.attendance_date  FROM attendance LEFT JOIN overtime ON overtime.emp_id = attendance.emp_id LEFT JOIN employee_tbl ON attendance.emp_id = employee_tbl.Emp_id  WHERE attendance.emp_id = 'GH101'