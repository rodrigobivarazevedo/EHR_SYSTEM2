<?php
require_once "database.php";

class Appointmentsinfo
{
    public function get_appointment_info($dbo, $speciality, $consultation_type)
    {
        try {
            if ($consultation_type !== null && $speciality === null) {
                $statement = $dbo->conn->prepare("SELECT consultation_type, speciality, clinic FROM appointmentsinfo WHERE consultation_type = :consultation_type");
            } elseif ($consultation_type !== null && $speciality !== null) {
                $statement = $dbo->conn->prepare("SELECT consultation_type, speciality, clinic FROM appointmentsinfo WHERE speciality = :speciality AND consultation_type = :consultation_type");
            }

            // Conditionally bind parameters
            if ($speciality !== null) {
                $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
            }
            if ($consultation_type !== null) {
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
            if ($clinic === null) {
                $statement = $dbo->conn->prepare("SELECT FirstName, LastName, Speciality FROM Doctors WHERE speciality = :speciality");
            } elseif ($speciality !== null && $clinic !==  null) {
                $statement = $dbo->conn->prepare("SELECT FirstName, LastName, Speciality FROM Doctors WHERE speciality = :speciality AND clinic = :clinic");
            }

            // Conditionally bind parameters
            if ($speciality !== null) {
                $statement->bindParam(':speciality', $speciality, PDO::PARAM_STR);
            }
            if ($clinic !== null) {
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
            
            $statement = $dbo->conn->prepare("SELECT clinic FROM Clinics WHERE speciality = :speciality");
            
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
            $validTables = ["Doctors", "appointmentsinfo", "Clinics"]; // Add valid table names as needed

            if (!in_array($table, $validTables)) {
                throw new Exception("Invalid table name");
            }

            $sql = "SELECT * FROM $table";
            $statement = $dbo->conn->prepare($sql);

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