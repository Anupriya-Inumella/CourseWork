topk=5;

trainArray=zeros(4,570,10000);
trainLabel=zeros(4,570,1);
testArray=zeros(4,190,10000);
testLabel=zeros(4,190,1);
trainArrayVariance=zeros(4,570,10000);
testArrayVariance=zeros(4,190,10000);
wTrainImages=zeros(4,570,topk);
wTestImages=zeros(4,190,topk);
answerLabel=zeros(4,190);
accuracy=zeros(4,1);
testArrayReconstruct=zeros(4,190,10000);


for i=1:4 
    trainSeq=0;
    testSeq=0;
    for j=1:4
        if i~=j
            %training folder
            for k=1:39
                if k~=14
                    for l=(5*(j-1)+1):(5*j)
                        filename=strcat('./kFold/',int2str(k),'/',int2str(j),'/',int2str(l),'.pgm');
                        im = imread(filename);
                        imReshaped=reshape(im,10000,1);
                        trainArray(i,trainSeq+1,:)=imReshaped(:);
                        trainLabel(i,trainSeq+1,1)=k;
                        trainSeq=trainSeq+1;
                    end    
                end   
            end    
        else
            %testing folder
            for k=1:39
                if k~=14
                    for l=(5*(j-1)+1):(5*j)
                        filename=strcat('./kFold/',int2str(k),'/',int2str(j),'/',int2str(l),'.pgm');
                        im = imread(filename);
                        imReshaped=reshape(im,10000,1);
                        testArray(i,testSeq+1,:)=imReshaped(:);
                        testLabel(i,testSeq+1,1)=k;
                        testSeq=testSeq+1;
                    end    
                end   
            end    
        end
    end    
end
%suppress second dimenstion to one mean :D
meanTrain = mean(trainArray,2);
for i=1:4
    for j=1:570
        for k=1:10000
            trainArrayVariance(i,j,k)=trainArray(i,j,k)-meanTrain(i,1,k);
        end    
    end
    for j=1:190
        for k =1:10000         
            testArrayVariance(i,j,k)=testArray(i,j,k)-meanTrain(i,1,k);
        end
    end
    product= reshape(trainArrayVariance(i,:,:),570,10000)*reshape(trainArrayVariance(i,:,:),570,10000)';
    [eigenVectors,eigenValues]=eigs(product,570,'lm');
    u=zeros(10000,topk);
    for j=1:topk
        for k=1:10000
            for l=1:570
                u(k,j)=u(k,j)+trainArrayVariance(i,l,k).*eigenVectors(l,j);
            end    
        end   
    end
    for j=1:topk
        u(:,j)=u(:,j)/norm(u(:,j));
    end 
    for j=1:570
        for k=1:topk
            for l=1:10000
                wTrainImages(i,j,k)=wTrainImages(i,j,k)+u(l,k)*trainArrayVariance(i,j,l);
            end
        end           
    end    
    for j=1:190
        for k=1:topk
            for l=1:10000
                wTestImages(i,j,k)=wTestImages(i,j,k)+u(l,k)*testArrayVariance(i,j,l);
            end
        end           
    end
    for j=1:190
        answerLabel(i,j)=knnclassify(reshape(wTestImages(i,j,:),1,5),reshape(wTrainImages(i,:,:),570,5),reshape(trainLabel(i,:,:),570,1),1,'euclidean','nearest');
    end
    for j=1:190
        if answerLabel(i,j)==testLabel(i,j,1)
            accuracy(i)=accuracy(i)+1;
        end    
    end
    for j=1:1
        for k=1:topk
            testArrayReconstruct(i,j,:)=testArrayReconstruct(i,j,:)+wTestImages(i,j,k)*reshape(u(:,k),1,1,10000);         
        end
        testArrayReconstruct(i,j,:)=testArrayReconstruct(i,j,:)+meanTrain(i,1,:);
        image(reshape(testArray(i,j,:),100,100));
    end    
end   

        