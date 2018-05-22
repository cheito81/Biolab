library("brew")
library("RJSONIO")

#Data reception from local
binpost  <- receiveBin()
inputDataFromLocal <- rawToChar(binpost)

if (isValidJSON(inputDataFromLocal, TRUE)) {
  inputData<-fromJSON(inputDataFromLocal, simplifyWithNames=FALSE)
"
inputData$action
inputData$controllerType
inputData$jsonData
"
  generatedFiles<-c()

  setwd("/var/www/html/RScripts/SQLAccess")
	source("SQLAccess.R")

  switch (as.character(inputData$action),
          "10000" = {

            mydb <- openDB("biolab", "biolab", "biolab", "localhost")
            allMolecules <- execSQLQuery(mydb, "select * from molecules")

            setwd("/var/www/html/BioLabTechnology/statisticsFiles/boxPlots")

            png("boxPlotMolecularWeight.png")
            boxplot(allMolecules$moleculeWeight,main="Box plot molecular weight")
            dev.off()

            png("histMolecularWeight.png")
            hist(allMolecules$moleculeWeight,main="Hist molecular weight")
            dev.off()

            file1<-"statisticsFiles/boxPlots/boxPlotMolecularWeight.png"
            file2<-"statisticsFiles/boxPlots/histMolecularWeight.png"

            statistic<-new.env(hash = TRUE)
            statistic$min<-min(allMolecules$moleculeWeight)
            statistic$max<-max(allMolecules$moleculeWeight)
            statistic$mean<- mean(allMolecules$moleculeWeight)

            statistic$median<- median(allMolecules$moleculeWeight, na.rm=FALSE)

            statistic$quantile <- quantile(allMolecules$moleculeWeight, c(0,0.1,0.2,0.8,1))


            statistic$range<-max(allMolecules$moleculeWeight)- min(allMolecules$moleculeWeight)
            IQR(allMolecules$moleculeWeight)


            statistic$var<-var(allMolecules$moleculeWeight)

            statistic$sd<-sd(allMolecules$moleculeWeight) # == sqrt(var(osteoporosisFile$edad))


          },
          "10010" = {


          }
  )

	outPutData <- c(1, file1, file2, statistic)

	sendBin (toJSON(outPutData))
}
