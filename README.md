# e_voting
cloud computing course project , phase 0

This Election Manager Module Is Written With php Programming Language.

config folder contains 'database.php' file , that used for create connection to database.
object folder contains 'electon.php' file , that defined election class and its variables and methods.
election folder contains different APIs for election entity.

To Run This Module , First You Should Create A Mysql Database Called 'e_voting'. 
Then Import 'db.sql' File on this database, To Create 'election' Table and insert sample records.

1.
//***************************************************
//First API (CreateElection)
To Run First API , make a request to "http://Server/e_voting/election/create_election.php" with a json input like :

input:
{
    "title": "election4",
    "start_time": "2014-01-01 00:00:00",
    "end_time": "2014-01-02 00:00:00",
    "list_of_choices": [
        "mansore",
        "masome",
        "tayebe"
    ],
    "number_of_votes": "400"
}

This will Create A New Record In 'election' Table.

2.
//***************************************************
//Second API (EditElection)
make a request to "http://Server/e_voting/election/create_election.php" with a json input like :

input:
{
    "id": "4"
    "title": "election4",
    "start_time": "2014-01-01 00:00:00",
    "end_time": "2014-01-02 00:00:00",
    "list_of_choices": [
        "mansore",
        "masome",
        "tayebe",
        "fatemeh"
    ],
    "number_of_votes": "400"
}

This will Edit record with id=4 in election table.

3.
//***************************************************
//Third API(RemoveElection)
to delete an election , make a request to "http://Server/e_voting/election/remove_election.php" and specify election id with a json input like :

input:
{
    "id" : "4"
}

This will remove record with id=4 from election table , if election is not running (running election : start_time < cuurent_time < end_time )

4.
//***************************************************
//Fourth API(IncremenetNumberOfVotes)
to vote to an election , make a request to "http://Server/e_voting/election/increament_number_of_votes.php" and specify election id with a json input like :

input:
{
    "id" : "4"
}

This will Increase the value of the 'number_of_votes' column by 1.

5.
//***************************************************
//Fifth API(getListOfChoices)
to get list of an election choices , make a request to "http://Server/e_voting/election/get_list_of_choices.php" and specify election id with a json input like :

input:
{
    "id" : "4"
}

This will return list of choices.

6.
//***************************************************
//Sixth API(getAllElections)
to get all elections , make a request to "http://Server/e_voting/election/get_all_elections.php"


7.
//***************************************************
//Seventh API(electionExists)
to check whether election exist or not , make a request to "http://Server/e_voting/election/election_exists.php" and specify election id with a json input like :

input:
{
    "id" : "4"
}

This Will specify whether election exist or not.

8.
//***************************************************
//Eighth API(getElectionDetails)
to get an election , make a request to "http://Server/e_voting/election/get_election_detail.php" and specify election id with a json input like :

input:
{
    "id" : "4"
}

This Will return election detail with id=4.
