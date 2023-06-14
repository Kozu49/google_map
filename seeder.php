<?php

    
// seeder
// / Generate dummy data for 100 rows
$rows = [];
for ($i = 0; $i < 20000; $i++) {
    $timestamp = date('m/d/Y H:i:s');
    $fullName = generateRandomName();
    $dob = generateRandomDate('1990-01-01', '2023-06-12');
    $passportNumber = generateRandomPassportNumber();
    $address = generateRandomAddress();
    
    $rows[] = [$timestamp, $fullName, $dob, $passportNumber, $address];
}
// Prepare the update request
$body = new Google_Service_Sheets_ValueRange([
    'values' => $rows
]);
$params = [
    'valueInputOption' => 'RAW'
];
$updateRequest = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
// Execute the update request
try {
    $response = $updateRequest->execute();
    echo "Updated range: " . $response->getUpdatedRange();
} catch (Google_Service_Exception $e) {
    $error = json_decode($e->getMessage());
    echo "Error updating spreadsheet: " . $error->error->message;
}


// Function to generate a random date
function generateRandomDate($startDate, $endDate)
{
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);
        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
        return date("Y-m-d", $randomTimestamp);
}

    // Function to generate a random name
    function generateRandomName()
    {
        $names = [ 'John', 'Jane', 'David', 'Emily', 'Michael', 'Emma', 'Daniel', 'Olivia', 'Sophia', 'Matthew',
        'Liam', 'Ava', 'Noah', 'Isabella', 'James', 'Mia', 'Benjamin', 'Charlotte', 'Lucas', 'Amelia',
        'Elijah', 'Harper', 'William', 'Evelyn', 'Alexander', 'Abigail', 'Daniel', 'Emily', 'Joseph',
        'Elizabeth', 'Henry', 'Sofia', 'Jacob', 'Grace', 'Samuel', 'Chloe', 'Andrew', 'Scarlett',
        'Jack', 'Victoria', 'Owen', 'Aria', 'Luke', 'Lily', 'Gabriel', 'Hannah', 'Caleb', 'Zoe',
        'Isaac', 'Nora', 'Nathan', 'Addison', 'Ryan', 'Ella', 'Ethan', 'Mila', 'Nicholas', 'Audrey',
        'Anthony', 'Bella', 'William', 'Penelope', 'Dylan', 'Leah', 'Christopher', 'Samantha', 'Sebastian',
        'Stella', 'Jackson', 'Maya', 'Christian', 'Madison', 'Josiah', 'Layla', 'Jonathan', 'Hazel',
        'Wyatt', 'Natalie', 'Julian', 'Brooklyn', 'Leo', 'Luna', 'Hunter', 'Avery', 'Eli', 'Ellie',
        'Isaiah', 'Claire', 'Aaron', 'Skylar', 'Charles', 'Anna', 'Thomas', 'Savannah', 'Connor', 'Ruby',
        'Cameron', 'Eva', 'Max', 'Lucy', 'Austin', 'Scarlet', 'Evan', 'Aubrey', 'Mason', 'Aurora',
        'Adam', 'Aaliyah', 'Adrian', 'Nevaeh', 'Ian', 'Quinn', 'Hudson', 'Alice', 'Cooper', 'Riley',
        'Carson', 'Sadie', 'Nolan', 'Katherine', 'Jordan', 'Alexa', 'Xavier', 'Allison', 'Blake', 'Gianna',
        'Jason', 'Madelyn', 'Riley', 'Sarah', 'Axel', 'Elizabeth', 'Zachary', 'Makayla', 'Julius', 'Ariana',
        'Jeremiah', 'Lillian', 'Dominic', 'Gabriella', 'Jose', 'Clara', 'Colton', 'Violet', 'Angel', 'Peyton',
        'Greyson', 'Camila', 'Levi', 'Lauren', 'Ian', 'Sophie', 'Easton', 'Lily', 'Brody', 'Natalia',
        'Adam', 'Reagan', 'Parker', 'Hailey', 'Kayden', 'Eleanor', 'Mateo', 'Eliana', 'Silas', 'Adeline',
        'Thomas', 'Elena', 'Kingston', 'Nova', 'Ezra', 'Genesis', 'Robert', 'Maria', 'Jaxon', 'Emilia',
        'Timothy', 'Brianna', 'Brayden', 'Valentina', 'Bentley', 'Willow', 'Joel', 'Delilah', 'Francisco', 'Isla',
        'Tristan', 'Melanie', 'Maxwell', 'Mya', 'Carlos', 'Naomi', 'Jesus', 'Athena', 'Kaden', 'Kylie',
        'Alex', 'Madeline', 'Cole', 'Kaitlyn', 'Miles', 'Isabelle', 'Micah', 'Eliana', 'Vincent', 'Charlie',
        'Harrison', 'Adalynn', 'Emmett', 'Makenna', 'Kai', 'Kaylee', 'Derek', 'Gabrielle', 'King', 'Alaina',
        'Jayce', 'Jade', 'Garrett', 'Liliana', 'George', 'Taylor', 'Luis', 'Faith', 'Victor', 'Maci',
        'Jake', 'Callie', 'Hayden', 'Anastasia', 'Ashton', 'Kayla', 'Weston', 'Leila', 'Ezekiel', 'Caroline',
        'Patrick', 'Piper', 'Ryder', 'Ariel', 'Bryson', 'Adriana', 'Richard', 'Elise', 'Joel', 'Lyla',
        'Peter', 'Isabel', 'Felix', 'Molly', 'Sawyer', 'Amaya', 'Preston', 'Emery', 'Greyson', 'Emerson',
        'Damian', 'Mckenzie', 'Elias', 'Angelina', 'Roman', 'Remi', 'Tucker', 'Amaya', 'Leo', 'Eliza',
        'Emmanuel', 'Mckenna', 'Arthur', 'Margaret', 'Colin', 'Aniyah', 'Leonardo', 'Summer', 'Bryan', 'Jasmine',
        'Emilio', 'Elaina', 'Jeremy', 'Genevieve', 'Carter', 'Laura', 'Andre', 'Alexandria', 'Phoenix', 'Daisy',
        'Reid', 'Daniela', 'Daxton', 'Nova', 'Everett', 'Hope', 'Amir', 'Alina', 'Ruben', 'Reese',
        'Hayes', 'Finley', 'Waylon', 'Diana', 'Jonah', 'Juliana', 'Frank', 'Brooke', 'Rafael', 'Rosalie',
        'Andy', 'Gabriela', 'Graham', 'Alana', 'Corbin', 'Presley', 'Luca', 'Payton', 'Shane', 'Vivian',
        'Beckett', 'Fiona', 'Travis', 'Arianna', 'Zane', 'Alivia', 'Brooks', 'Alexia', 'August', 'Georgia',
        'Maximus', 'Juliette', 'Elliot', 'Josie', 'Rhett', 'Dakota', 'Erick', 'Tessa', 'Jude', 'Nova',
        'Nathaniel', 'Camilla', 'Victor', 'Sienna', 'Brandon', 'Hope', 'Lorenzo', 'Sierra', 'Giovanni', 'Chelsea',
        'Antonio', 'Catherine', 'Hayden', 'Erin', 'Kaleb', 'Annabelle', 'Bryce', 'Annie', 'Maddox', 'Raelynn',
        'Axel', 'Haven', 'Edward', 'Jacqueline', 'Brantley', 'Lucia', 'Ryker', 'Mariana', 'Abraham', 'Emerson',
        'Leland', 'Desiree', 'Erick', 'Felicity', 'Mario', 'Kira', 'Jonas', 'Haley', 'Dawson', 'Amy',
        'Scott', 'Leslie', 'Walker', 'Kenzie', 'Caden', 'Kate', 'Tanner', 'Jayla', 'Keegan', 'Ayla',
        'Israel', 'Leilani', 'Jesse', 'Harmony', 'Zayden', 'Macie', 'River', 'Phoebe', 'Dante', 'Selena',
        'Troy', 'Adelyn', 'Dominick', 'Ruth', 'Hector', 'Miranda', 'Reece', 'Cora', 'Quinn', 'Adelaide',
        'Cohen', 'Lila', 'Jayson', 'Jordyn', 'Gunner', 'Nyla', 'Drew', 'Haylee', 'Mohamed', 'Bianca',
        'Julio', 'Cassidy', 'Cruz', 'Addyson', 'Mekhi', 'Delaney', 'Ali', 'Skyla', 'Maximiliano', 'Angelica',
        'Raul', 'Samara', 'Dakota', 'Kinley', 'Ronald', 'Ainsley', 'Augustus', 'Lexi', 'Reese', 'Alexia',
        'Benson', 'Delilah', 'Hayes', 'Aliyah', 'Masen', 'Brielle', 'Russell', 'Juniper', 'Solomon', 'Eden',
        'Hugo', 'Myla', 'Cyrus', 'Aurelia', 'Asa', 'Megan', 'Nash', 'Nina', 'Royal', 'Kamryn',
        'Salvador', 'Georgia', 'Joey', 'Phoebe', 'Alijah', 'Journee', 'Yusuf', 'Angel', 'Byron', 'Katelyn',
        'Hamza', 'Lia', 'Nickolas', 'Haven', 'Damon', 'Braelynn', 'Dexter', 'Emersyn', 'Orion', 'Everleigh',
        'Luka', 'Mallory', 'Reyansh', 'Madilyn', 'Mauricio', 'Helen', 'Lance', 'Jada', 'Leonel', 'Kinley',
        'Armando', 'Nadia', 'Maverick', 'Anaya', 'Knox', 'Julianna', 'Kade', 'Kayleigh', 'Ali', 'Celeste',
        'Raymond', 'Catalina', 'Dallas', 'Gia', 'Kyson', 'Zara', 'Winston', 'Talia', 'Ariel', 'Brynn',
        'Mitchell', 'Lilah', 'Albert', 'Kaia', 'Enzo', 'Lena', 'Jasiah', 'Gabriela', 'Russell', 'Melissa',
        'Walter', 'Dayana', 'Finley', 'Macy', 'Arjun', 'Malia', 'Uriel', 'Jazmine', 'Julien', 'Bristol',
        'Alfredo', 'Lana', 'Franklin', 'Lorelei', 'Kieran', 'Scarlet', 'Jamison', 'Alejandra', 'Kane', 'Zuri',
        'Javier', 'Holly', 'Brady', 'Demi', 'Anderson', 'Eloise', 'Oscar', 'Estrella', 'Ace', 'Mira',
        'Randy', 'Ashlynn', 'Lionel', 'Kailani', 'Leonidas', 'Arabella', 'Morgan', 'Elle', 'Conrad', 'Erica',
        'Kobe', 'Laney', 'Quentin', 'Angelique', 'Sullivan', 'Remy', 'Gideon', 'Hallie', 'Adonis', 'Sasha',
        'Sol', 'Esmeralda', 'Tristen', 'Nylah', 'Korbin', 'Janelle', 'Payton', 'Justice', 'Alden', 'Caitlyn',
        'Ismael', 'Emely', 'Dax', 'Alison', 'Dorian', 'Madelynn', 'Gianni', 'Nayeli', 'Colten', 'Rylie',
        'Prince', 'Elisa', 'Cassius', 'Amari', 'Gerald', 'Lacey', 'Beckham', 'Kassandra', 'Reuben', 'Clementine',
        'Jon', 'Maia', 'Callum', 'Lilian', 'Leonard', 'Jolie', 'Clayton', 'Anabelle', 'Karson', 'Emmalyn',
        'Muhammad', 'Elsa', 'Frankie', 'Helena', 'Kian', 'Gwendolyn', 'Shaun', 'Jazmin', 'Ronan', 'Juniper',
        'Kendrick', 'Dahlia', 'Theodore', 'Chelsea', 'Tate', 'Julieta', 'Adrien', 'Lilyana', 'Amos', 'Blakely',
        'Issac', 'Adelynn', 'Dennis', 'Ivy', 'Colby', 'Aleah', 'Cason', 'Mikayla', 'Orlando', 'Anne',
        'Daxton', 'Joselyn', 'Eden', 'Emory', 'Kelvin', 'Annabella', 'Aarav', 'Coraline', 'Darius', 'Nancy',
        'Sylas', 'Anika', 'Dustin', 'Emilee', 'Kaysen', 'Raven', 'Lucca', 'Yaretzi', 'Mathew', 'April',
        'Jasiah', 'Marlee', 'Kannon', 'Aubrie', 'Branden', 'Crystal', 'Bruce', 'Elisabeth', 'Nick', 'Anahi',
        'Moses', 'Madisyn', 'Ricky', 'Joslyn', 'Sam', 'Lainey', 'Edison', 'Madilynn', 'Marshall', 'Jane',
        'Cullen', 'Kaylani', 'Malik', 'Danica', 'Mohammad', 'Kaylie', 'Kelvin', 'Tiffany', 'Maurice', 'Anabella',
        'Lachlan', 'Sloan', 'Davis', 'Elyse', 'Kylan', 'Galilea', 'Kobe', 'Lizbeth', 'Leon', 'Jaylin',
        'Karson', 'Arya', 'Lucian', 'Joslyn', 'Kase', 'Kaylin', 'Lennon', 'Marissa', 'Jalen', 'Milani',
        'Mekhi', 'Alanna', 'Reese', 'Jaliyah', 'Francis', 'Braelyn', 'Arturo', 'Linda', 'Terry', 'Kiera',
        'Keith', 'Matilda', 'Jessie', 'Amirah', 'Noe', 'Gloria', 'Keaton', 'Lucille', 'Sincere', 'Maeve',
        'Terrence', 'Simone', 'Harry', 'Marie', 'Korbin', 'Madalyn', 'Darrell', 'Jordynn', 'Castiel', 'Zaria',
        'Johan', 'Bethany', 'Kody', 'Erika', 'Layton', 'Nathalia', 'Jamal', 'Kaydence', 'Keenan', 'Rosa',
        'Kristopher', 'Daphne', 'Boston', 'Carolyn', 'Rodrigo', 'Zoie', 'Harvey', 'Jayleen', 'Larry', 'Malaya',
        'Reginald', 'Lara', 'Douglas', 'Clare', 'Mohammed', 'Kinsley', 'Cory', 'Tiana', 'Duke', 'Raven',
        'Gustavo', 'Lilianna', 'Rey', 'Cindy', 'Aryan', 'Amia', 'Jamari', 'Elliot', 'Roy', 'Noa',
        'Kamari', 'Jenny', 'Jamir', 'Emmalynn', 'Dorian', 'Saniyah', 'Roberto', 'Keyla', 'Arlo', 'Aisha',
        'Yousef', 'Heaven', 'Kian', 'Meredith', 'Ezequiel', 'Emelia', 'Joey', 'Myah', 'Lennon', 'Maren',
        'Kendall', 'Aylin', 'Leandro', 'Avah', 'Stanley', 'Cara', 'Ramon', 'Jayde', 'Marvin', 'Savanna',
        'Korbin', 'Lea', 'Kellen', 'Bridget', 'Davion', 'Analia', 'Jovanni', 'Janiyah', 'Jair', 'Jaelyn',
        'Kristian', 'Jessie', 'Brock', 'Annika', 'Junior', 'Nataly', 'Allan', 'Amalia', 'Brenden', 'Madyson',
        'Colson', 'Scarlette', 'Yael', 'Ashlyn', 'Briggs', 'Audrina', 'Deacon', 'Kimber', 'Bryant', 'Leia',
        'Semaj', 'Amirah', 'Frederick', 'Zainab', 'Shawn', 'Kenley', 'Jovanni', 'Emmeline', 'Kasey', 'Jaycee',
        'Ty', 'Lesly', 'Lennon', 'Miah', 'Alessandro', 'Charlize', 'Aditya', 'Amelie', 'Giovani', 'Annalise',
        'Jordyn', 'Reyna', 'Santino', 'Tara', 'Tyrell', 'Brenna', 'Aron', 'Evalyn', 'Omari', 'Nia',
        'Guillermo', 'Saniya', 'Jonathon', 'Bria', 'Cedric', 'Casey', 'Desmond', 'Zariyah', 'Rogelio', 'Karlee',
        'Abdullah', 'Lylah', 'Braeden', 'Rosa', 'Jadon', 'Lindsey', 'Justus', 'Miya', 'Cristopher', 'Lizeth',
        'Crosby', 'Marisol', 'Jordy', 'Alyson', 'Blaze', 'Hayley', 'Reggie', 'Adelina', 'Lamar', 'Azalea',
        'Niko', 'Hadassah', 'Quincy', 'Ivanna', 'Dariel', 'Justice', 'Emery', 'Lorelai', 'Kam'];
        $randomIndex = mt_rand(0, count($names) - 1);
        return $names[$randomIndex];
    }

    // Function to generate a random passport number
        function generateRandomPassportNumber()
        {
            return mt_rand(100000000, 999999999);
        }

        // Function to generate a random address
    function generateRandomAddress()
    {
        $addresses = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi' ,'Akita', 'Yamagata','Fukushima','Ibaraki','Tochigi','Gunma','Saitama','Chiba','Tokyo','Kanagawa','Niigata','Toyama','Ishikawa','Fukui','Yamanashi','Nagano','Gifu','Shizuoka','Aichi','Mie','Shiga','Kyoto','Osaka','Hyogo','Nara','Wakayama','Tottori','Shimane','Okayama','Hiroshima','Yamaguchi','Tokushima','Kagawa','Ehime','Kochi','Fukuoka','Saga','Nagasaki','Kumamoto','Oita','Miyazaki','Kagoshima','Okinawa'];
        $randomIndex = mt_rand(0, count($addresses) - 1);
        return $addresses[$randomIndex];
    }

    // seeder end