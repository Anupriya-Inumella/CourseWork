tr=[];
te=[];
tr_label=[];
te_label=[];
for i=1:2856
    if( rem(i,4) == 0 )
        te = [te;CMUPIEData(i).pixels];
        te_label = [te_label;CMUPIEData(i).label];
    else
        tr = [tr;CMUPIEData(i).pixels];
        tr_label = [tr_label;CMUPIEData(i).label];
    end
end

m = mean(tr);
for i=1:size(tr,1)
    b(:,i) = tr(i,:) - m;
end

topk = 11;
[v,d] = eigs(b*b',topk,'lm');
eig_values = diag(d)'; %1024 elements


wTr=[];
for i=1:size(tr,1);
    wTr=[wTr,zeros(size(v,2),1)];
end
for i=1:size(tr,1)
    tmp=[];
    for j=1:size(v,2)
        tmp=[tmp; dot(tr(i,:)',v(:,j))];
     %   wTr(i)=[wTr(i),tmp];
    end
    %wTr=[wTr,wTr(i)]
    wTr(:,i)=tmp;
end

%SVMStruct = svm_train(wTr',tr_label);

count=0;
for i=1:size(te,1)
    tmp1=[];
    for j=1:size(v,2)
        tmp1=[tmp1,dot(te(i,:)',v(:,j))];
    end
    pred=knnclassify(tmp1, wTr', tr_label, 1, 'euclidean','nearest');
    %pred = svm_predict(SVMStruct,tmp1);
    fprintf('Label predicted= %d, real label= %d\n',pred,te_label(i));
    if(pred==te_label(i))
        count=count+1;
    end
end
fprintf('Count=%d\n',count);
fprintf('Accuracy=%d\n',count/size(te,1));
% ROC 100 pairs, 500 same, 500 different
cs1=0; cd=0;
d=[];
a=[ones(500,1)',zeros(500,1)'];
b=zeros(1000,1);
for i=1:1000
    d=[d,[zeros(topk,1)';zeros(topk,1)']];
end
cd=501;
cs1=1;
for i=1:size(tr_label,1)-1
    if(tr_label(i)~=tr_label(i+1))
        if(cd<1000)
            d(1,(topk*cd)-(topk-1):(topk*cd))=wTr(:,i)';
            d(2,(topk*cd)-(topk-1):(topk*cd))=wTr(:,i+1)';
            b(cd) = pdist2(wTr(:,i)',wTr(:,i+1)');
            cd=cd+1;
        end
    else
        if(cs1<500)    
            %d(:,cs1)=[wTr(:,i)';wTr(:,i+1)'];
            d(1,(topk*cs1)-(topk-1):(topk*cs1))=wTr(:,i)';
            d(2,(topk*cs1)-(topk-1):(topk*cs1))=wTr(:,i+1)';
            b(cs1) = pdist2(wTr(:,i)',wTr(:,i+1)');
            cs1=cs1+1;
        end
    end
end
[x, y, t, k, opt] = perfcurve(a',b,1); 
plot(x,y);