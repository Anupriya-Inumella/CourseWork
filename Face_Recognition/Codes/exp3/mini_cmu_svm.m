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

topk = 5
[v,d] = eigs(b*b',topk,'lm');
eig_values = diag(d)' %1024 elements


wTr=[]
for i=1:size(tr,1)
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
count=0;
for i=1:size(te,1)
    tmp1=[];
    for j=1:size(v,2)
        tmp1=[tmp1,dot(te(i,:),v(:,j))];
    end;
    pred_lables = []
    for j=1:size(wTr,2)-1
        model = svmtrain([wTr(:,j),wTr(:,j+1)]',[int2str(tr_label(j));int2str(tr_label(j+1))],'Kernel_Function','rbf');
        pred_lables = [pred_lables,svmclassify(model,tmp1)];
    end
    pred = mode(pred_lables);
    fprintf('Label predicted= %d, real label= %d\n',pred,te_label(i));
    if(pred==te_label(i))
        count=count+1;
    end
end

fprintf('Accuracy=%d\n',count/size(te,1));