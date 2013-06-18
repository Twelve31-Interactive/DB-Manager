#include <stdlib.h>
#include <stdio.h>
#include <string.h>

#define FIELD_NUM 23 // number of fields in the file 
#define ROW_NUM 10000 // max length of the temp string for each row in file

int main( void ){

	/***************************
	 *
	 * VARIABLES
	 */
	static const char filename[] = "twelve31_list.txt";
	static const char outfilename[] = "out.txt";
    FILE *fp,*ofp; 
	char row[ROW_NUM], temp[ROW_NUM];
	char delim[] = "|";
	char *result, *token;
	long fileCount = 0;
	int i, len, c;

	/*********************
	 *
	 * COUNT ROWS
	 *
	 */
	fp = fopen(filename,"rb");
	if( fp != NULL ) {

	ofp = fopen(outfilename,"w+");
	if( ofp == NULL ) {
		printf("COULD NOT OPEN OUT FILE\n");	
	}

		// file did exist
		while( fgets(row,sizeof row, fp) != NULL ) {
			
			if( fileCount == 901000 ) {
				break;	
			}

			len = strlen(row);
			if( row[len-1] == '\n' ){
				row[len-1] = '\0';
			}
			if( row[len-2] == '\r' ) {
				row[len-2] = '\0';
			}
			if( row[len-3] == '|' ) {
				strcat(row,"bG9jYWwubG9jYWw=");
			}

			fprintf(ofp,"%s\n",row);	
			//printf("%d\n\n",len);	
			fileCount++;
		}
	} else {
		// file did not exist
		perror( filename );	
	}	

	fclose(fp);
	if( ofp != NULL ){
		fclose(ofp);
	}

	printf("%d Complete!\n",fileCount);
	return 0;
}
