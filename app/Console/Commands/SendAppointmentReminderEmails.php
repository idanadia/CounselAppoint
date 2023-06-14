<?php

namespace App\Console\Commands;

use App\Mail\AppointmentReminderForClient;
use App\Mail\AppointmentReminderForCounselor;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send appointment reminder emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get appointments scheduled 24 hours from now
        $appointments24Hour = Appointment::whereDate('appointmentDate', Carbon::now()->addDay()->toDateString())
            ->get();

        // Get appointments scheduled 8 hours from now
        $appointments8Hour = Appointment::whereDate('appointmentDate', Carbon::now()->addHours(8)->toDateString())
            ->get();

        // Combine the appointments
        $appointments = $appointments24Hour->concat($appointments8Hour);

        foreach ($appointments as $appointment) {
            // Get the associated timeslot start time
            $timeslotStartTime = Carbon::parse($appointment->timeslot->startTime)->toTimeString();

            // Calculate the reminder datetime
            $reminderDateTime24Hour = Carbon::parse($appointment->appointmentDate . ' ' . $timeslotStartTime)
                ->subDay();

            $reminderDateTime8Hour = Carbon::parse($appointment->appointmentDate . ' ' . $timeslotStartTime)
                ->subHours(8);

            // Check if it's time to send the reminder
            if (Carbon::now() >= $reminderDateTime24Hour) {
                // Send the 24-hour reminder email
                Mail::to($appointment->client->email)->send(new AppointmentReminderForClient($appointment));
                Mail::to($appointment->counselor->email)->send(new AppointmentReminderForCounselor($appointment));
            }

            if (Carbon::now() >= $reminderDateTime8Hour) {
                // Send the 8-hour reminder email
                Mail::to($appointment->client->email)->send(new AppointmentReminderForClient($appointment));
                Mail::to($appointment->counselor->email)->send(new AppointmentReminderForCounselor($appointment));
            }
        }

        $this->info('Appointment reminder emails sent successfully.');
    }
}
