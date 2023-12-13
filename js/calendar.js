
// Function to create the calendar
 function createCalendar(data) {
    const data = calendarData;
    const calendar = document.getElementById('calendar');

    // Get unique dates from the data
    const uniqueDates = [...new Set(data.map(item => item.DATE))];

    // Iterate through each date
    uniqueDates.forEach(date => {
        const dateObject = new Date(date);
        const dayOfWeek = dateObject.toLocaleDateString('en-US', { weekday: 'short' });
        const day = dateObject.getDate();
        const monthAbbreviation = dateObject.toLocaleDateString('en-US', { month: 'short' });
        const startTime = data.find(item => item.DATE === date).StartTime;
        const year = dateObject.getFullYear();

        const dayElement = document.createElement('button');
        dayElement.classList.add('day');

        // Check if the date has available time slots
        const availableSlots = data.filter(item => item.DATE === date);
        if (availableSlots.length > 0) {
            dayElement.classList.add('available');
        }

        dayElement.textContent = `${dayOfWeek}, ${day} ${monthAbbreviation} ${year}`;

        // Add a click event listener to handle appointment creation
        dayElement.addEventListener('click', () => {
            // Replace this with your appointment creation logic
            get_timeslots(date);
        });

        calendar.appendChild(dayElement);
    });
} 


