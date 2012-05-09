 - We open the file
 - Read each line
 - Until we find a section marker
 - skip the recordset section marker
 - find the dataset marker
   - store the dataset properties in an array in the dataset property
 - find the linkages marker
   - see if it points to a separate file
   - find each linkages section
     - store each section in a subarray of linkages property
 - reopen the file at the beginning
 - open a new turtle file
 - write the turtle header
 - read each record
   - combine with proper prefixes
   - look for errors
   - write the turtle
 - close both files

Note: we should have a flag to write the linkages out separately

To create csv:

 - we start with RDF - turtle or N3
 - open the RDF file
 - does a linkages file already exist?
   - yes
     - open the linkages file
     - read prefix section and add to prefixes parameter
     - read attributes section and add to a properties parameter array
     - read the list sections and add to the lists parameter array
   - no
     - grab the prefixes and add to prefixes parameter
     - read each resource
       - add the properties to a properties parameter array
       - we skip the values at this point
     - reopen the RDF file at the beginning
 - find each resource
   - start a row array with the URI, using the properties parameter array as a template
   - match each property with the hash in the row array
   - if we have list parameters, we match on the URI in the RDF
     - if we have URIs without matching literals we add them to the current list parameter anyway
   - write the row
 - create the dataset section
 - write to disk
 - create the linkages section
 - write to either a separate file or current file depending on config
 - close the files
