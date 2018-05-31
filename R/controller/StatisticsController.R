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

  setwd("/home/alumnes/dawbio1805/public_html/R/SQLAccess")
  source("SQLAccess.R")

  switch (as.character(inputData$action),
          "10000" = {

            mydb <- openDB("dawbio1805", "Ew5kaer6", "dawbio1805", "localhost")
            allMolecules <- execSQLQuery(mydb, "select * from molecules")

            setwd("/home/alumnes/dawbio1805/public_html/statisticsFiles/boxPlots")

            png("boxPlotMolecularWeight.png")
            boxplot(allMolecules$full_mwt,main="Box plot molecular weight")
            dev.off()

            png("histMolecularWeight.png")
            hist(allMolecules$full_mwt,main="Hist molecular weight")
            dev.off()

            file1<-"statisticsFiles/boxPlots/boxPlotMolecularWeight.png"
            file2<-"statisticsFiles/boxPlots/histMolecularWeight.png"

            statistic<-new.env(hash = TRUE)
            statistic$min<-min(allMolecules$full_mwt)
            statistic$max<-max(allMolecules$full_mwt)
            statistic$mean<- mean(allMolecules$full_mwt)

            statistic$median<- median(allMolecules$full_mwt, na.rm=FALSE)

            statistic$quantile <- quantile(allMolecules$full_mwt, c(0,0.1,0.2,0.8,1))


            statistic$range<-max(allMolecules$full_mwt)- min(allMolecules$full_mwt)
            IQR(allMolecules$full_mwt)


            statistic$var<-var(allMolecules$full_mwt)

            statistic$sd<-sd(allMolecules$full_mwt) # == sqrt(var(osteoporosisFile$edad))


          },
          "10010" = {


          }
  )

  outPutData <- c(1, file1, file2, statistic)

  sendBin (toJSON(outPutData))
}
