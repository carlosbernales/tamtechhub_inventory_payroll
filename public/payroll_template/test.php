<script>
     } else if (dropdownValue === "Regular Holiday") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));
        
                var NightDiff = parseFloat(row.find('td:eq(3)').text());
                var overtime = parseFloat(row.find('td:eq(6)').text());
                var NDovertime = parseFloat(row.find('td:eq(7)').text());
                var overtimePay = parseFloat(row.find('td:eq(8)').data('original-overtime-pay'));
                //regular holiday pay
                var salaryDivideWorkhours = originalDailySalary / requiredWork;
                var regularholdaypay = salaryDivideWorkhours * 2 * requiredWork; // Update daily salary
                //regular holiday overtime pay
                var regularholdayovertime = salaryDivideWorkhours * 2 * 1.3 * overtime ; // Update daily salary
                //regular holiday night differential pay
                var regularholdayNDpay = salaryDivideWorkhours * 2 * 0.1 * NightDiff ; // Update daily salary
                //regular holiday night diff overtime pay
                var regularholdayNDovertimepay1 = salaryDivideWorkhours * 2 * 1.3 * 0.1 * NDovertime ; // Update daily salary
                var regularholdayNDovertimepay2 = salaryDivideWorkhours * NDovertime ; // Update daily salary
                var regularholdayNDovertimepay = regularholdayNDovertimepay1 + regularholdayNDovertimepay2 ; // Update daily salary

                var totalovertimepay = regularholdayovertime + regularholdayNDovertimepay;

                var totalpay = totalovertimepay + regularholdaypay + regularholdayNDpay;

                row.find('td:eq(0)').text('₱' +regularholdaypay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(8)').text('₱' +totalovertimepay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(9)').text('₱' +totalpay.toFixed(2)); // Update total_pay column

            } else if (dropdownValue === "Regular Holiday + Rest Day") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));
        
                var NightDiff = parseFloat(row.find('td:eq(3)').text());
                var overtime = parseFloat(row.find('td:eq(6)').text());
                var NDovertime = parseFloat(row.find('td:eq(7)').text());
                var overtimePay = parseFloat(row.find('td:eq(8)').data('original-overtime-pay'));
                //regular holiday pay
                var salaryDivideWorkhours = originalDailySalary / requiredWork;
                var regularholdayrestdaypay = salaryDivideWorkhours * 2 * 1.3 * requiredWork; // Update daily salary
                //regular holiday overtime pay
                var regularholdayrestdayovertime = salaryDivideWorkhours * 2.6 * 1.3 * overtime ; // Update daily salary
                //regular holiday night differential pay
                var regularholdayrestdayNDpay = salaryDivideWorkhours * 2.6 * 1.1 * NightDiff ; // Update daily salary
                //regular holiday night diff overtime pay
                var regularholdayrestdayNDovertimepay1 = salaryDivideWorkhours * 2.6 * 1.1 * 0.1 * NDovertime ; // Update daily salary
                var regularholdayrestdayNDovertimepay2 = salaryDivideWorkhours * NDovertime ; // Update daily salary
                var regularholdayrestdayNDovertimepay = regularholdayrestdayNDovertimepay1 + regularholdayrestdayNDovertimepay2 ; // Update daily salary

                var totalovertimepay = regularholdayrestdayovertime + regularholdayrestdayNDovertimepay;

                var totalpay = totalovertimepay + regularholdayrestdaypay + regularholdayrestdayNDpay;

                row.find('td:eq(0)').text('₱' +regularholdayrestdaypay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(8)').text('₱' +regularholdayrestdayNDpay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(9)').text('₱' +totalpay.toFixed(2)); // Update total_pay column

            } else if (dropdownValue === "Non-special Holiday") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));
        
                var NightDiff = parseFloat(row.find('td:eq(3)').text());
                var overtime = parseFloat(row.find('td:eq(6)').text());
                var NDovertime = parseFloat(row.find('td:eq(7)').text());
                var overtimePay = parseFloat(row.find('td:eq(8)').data('original-overtime-pay'));
                //nonspecial holiday pay
                var salaryDivideWorkhours = originalDailySalary / requiredWork;
                var nonspecialholidaypay = salaryDivideWorkhours * 1.3 * requiredWork; // Update daily salary
                //non special holiday overtime pay
                var nonspecialholidayovertime = salaryDivideWorkhours * 1.3 * 1.3 * overtime ; // Update daily salary
                //non special holiday night differential pay
                var nonspecialholidayNDpay = salaryDivideWorkhours * 1.3 * 0.1 * NightDiff ; // Update daily salary
                //non special holiday night diff overtime
                var nonspecialholidayNDovertimepay = salaryDivideWorkhours * 1.3 * 0.1 * 1.3 * NDovertime ; // Update daily salary

                var nonspecialholidaytotalovertimepay = nonspecialholidayovertime + nonspecialholidayNDovertimepay;
                
                var totalpay = nonspecialholidaytotalovertimepay + nonspecialholidaypay + nonspecialholidayNDpay;

                row.find('td:eq(0)').text('₱' +nonspecialholidaypay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(8)').text('₱' +nonspecialholidayNDpay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(9)').text('₱' +totalpay.toFixed(2)); // Update total_pay column
                
            } else if (dropdownValue === "Non-special Holiday + Rest Day") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));
        
                var NightDiff = parseFloat(row.find('td:eq(3)').text());
                var overtime = parseFloat(row.find('td:eq(6)').text());
                var NDovertime = parseFloat(row.find('td:eq(7)').text());
                var overtimePay = parseFloat(row.find('td:eq(8)').data('original-overtime-pay'));
                //nonspecial holiday pay
                var salaryDivideWorkhours = originalDailySalary / requiredWork;
                var nonspecialholidayRDpay = salaryDivideWorkhours * 1.5 * requiredWork; // Update daily salary
                //non special holiday overtime pay
                var nonspecialholidayRDovertime = salaryDivideWorkhours * 1.5 * 1.3 * overtime ; // Update daily salary
                //non special holiday night differential pay
                var nonspecialholidayNDpay = salaryDivideWorkhours * 1.5 * 0.1 * NightDiff ; // Update daily salary
                
                var totalpay = nonspecialholidayRDovertime + nonspecialholidayRDpay + nonspecialholidayNDpay;

                row.find('td:eq(0)').text('₱' +nonspecialholidayRDpay.toFixed(2)); // Update daily_salary column
                row.find('td:eq(8)').text('₱' +nonspecialholidayRDovertime.toFixed(2)); // Update daily_salary column
                row.find('td:eq(9)').text('₱' +totalpay.toFixed(2)); // Update total_pay column
</script>