<?php
require_once "database.php";

class Appointmentsinfo
{
    public function get_appointment_info($dbo, $speciality, $consultation_type)
    {
        try {
            if ($consultation_type !== "" && $speciality === "") {
                $statement = $dbo->conn->prepare("SELECT consultation_type, speciality, clinic FROM appointmentsinfo WHERE consultation_type = :consultation_type");
            } else if ($consultation_type === "" && $speciality !== "") {
                $statement = $dbo->conn->prepare("SELECT consultation_type, speciality, clinic FROM appointmentsinfo WHERE speciality = :speciality");
            }else if ($consultation_type !== "" && $speciality !== "") {
                $statement = $dbo->conn->prepare("SELECT consultation_type, speciality, clinic FROM appointmentsinfo WHERE speciality = :speciality AND consultation_type = :consultation_type");
            }
            // Conditionally bind parameters
            if ($speciality !== "") {
                $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
            }
            if ($consultation_type !== "") {
                $statement->bindParam(':consultation_type', $consultation_type, PDO::PARAM_STR);
            }

            // Execute statement
            $statement->execute();

            // Fetch results
            $returned_value = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Encode the array as JSON and return it
            return json_encode($returned_value);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            return json_encode(["error" => $e->getMessage()]);
        }
    }

}



class Doctorsinfo
{
    public function get_doctors_info($dbo, $speciality, $clinic)
    {
        try {
            if ($clinic === "") {
                $statement = $dbo->conn->prepare("SELECT d.FirstName, d.LastName, d.Speciality, c.Name as clinic FROM Doctors d
                JOIN doctorclinic dc ON dc.DoctorID = d.DoctorID
                JOIN clinics c ON c.ClinicID = dc.ClinicID
                WHERE d.Speciality = :speciality");

            } else if ($speciality == "") {
                $statement = $dbo->conn->prepare("SELECT d.FirstName, d.LastName, d.Speciality, c.Name as clinic FROM Doctors d
                JOIN doctorclinic dc ON dc.DoctorID = d.DoctorID
                JOIN clinics c ON c.ClinicID = dc.ClinicID
                WHERE c.Name = :clinic");

            } else if ($speciality !== "" && $clinic !==  "") {
                $statement = $dbo->conn->prepare("select d.FirstName, d.LastName, d.Speciality, c.Name as clinic from Doctors d
                join doctorclinic dc on dc.DoctorID = d.DoctorID
                join clinics c on c.clinicID = dc.clinicID
                where c.Name = :clinic AND d.Speciality = :speciality");
            } 

            // Conditionally bind parameters
            if ($speciality !== "") {
                $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
            }
            if ($clinic !== "") {
                $statement->bindParam(':clinic', $clinic, PDO::PARAM_STR);
            }

            // Execute statement
            $statement->execute();

            // Fetch results
            $returned_value = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Encode the array as JSON and return it
            return json_encode($returned_value);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log, display an error message)
            return json_encode(["error" => $e->getMessage()]);
        }
    }

}


class Clinicsinfo
{
    public function get_clinic_info($dbo, $speciality)
    {
        try {
            if ($speciality !== "") {
                $statement = $dbo->conn->prepare("SELECT c.Name, c.location FROM clinics c
                JOIN clinicspecialities cs ON cs.ClinicID = c.ClinicID
                JOIN specialities s ON s.SpecialityID = cs.SpecialityID
                WHERE s.name = :speciality;"
                );
            } 

            // Conditionally bind parameters
            
            $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
            
           
            // Execute statement
            $statement->execute();

            // Fetch results
            $returned_value = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Encode the array as JSON and return it
            return json_encode($returned_value);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log, display an error message)
            return json_encode(["error" => $e->getMessage()]);
        }
    }

}

class All_Info
{
        public function get_all_info($dbo, $table)
    {
        try {
            // Ensure that $table is a valid table name (to avoid SQL injection)
            $validTables = ["Doctors", "appointmentsinfo", "clinics"]; // Add valid table names as needed

            if (!in_array($table, $validTables)) {
                throw new Exception("Invalid table name");
            }

            if ($table === "Doctors") {
                $statement = $dbo->conn->prepare("SELECT D.FirstName, D.LastName, D.Speciality, C.Name AS clinic FROM Doctors D
                LEFT JOIN DoctorClinic DC ON D.DoctorID = DC.DoctorID
                LEFT JOIN Clinics C ON DC.ClinicID = C.ClinicID");
            } else {
                $statement = $dbo->conn->prepare("SELECT * FROM $table");

            } 

            // Execute statement
            $statement->execute();

            // Fetch results
            $returned_value = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Encode the array as JSON and return it
            return json_encode($returned_value);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log, display an error message)
            return json_encode(["error" => $e->getMessage()]);
        } catch (Exception $e) {
            return json_encode(["error" => $e->getMessage()]);
        }
    }

}

?>