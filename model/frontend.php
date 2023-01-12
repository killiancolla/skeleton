<?php



function dbConnect()
{
        $db = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '');
        return $db;
}

// exemple get all 

/* 
function getAll()
{
    $dbh = dbConnect();
    $composants = $dbh->prepare("SELECT * FROM tablename");
    $composants->execute();

    return $composants->fetchAll();
}
*/

// exemple get unique 

/*
function get($id)
{
    $dbh = dbConnect();
    $req = $dbh->query("SELECT * FROM tablename WHERE id=idcomp");
    return $req->fetch();
}
*/

// exemple update / delete / insert 

/*
function update($id)
{
    $dbh = dbConnect();
    $composant = $dbh->prepare("UPDATE tablename SET columnname = columnvalue WHERE id = ?");
    $affectedLines = $composant->execute(array($id));
    return $affectedLines;
}
*/