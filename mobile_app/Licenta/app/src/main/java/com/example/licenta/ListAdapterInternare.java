package com.example.licenta;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

public class ListAdapterInternare extends RecyclerView.Adapter{
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_internare,parent,false);

        return new ListAdapterInternare.ListViewHolder(view);
    }
    public void onBindViewHolder(RecyclerView.ViewHolder holder, int position){
        ((ListAdapterInternare.ListViewHolder) holder).bindView(position);

    }
    public int getItemCount(){
        return MainActivity.InternariList.size();
    }
    private class ListViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        private TextView mTextDataInternare;
        private TextView mTextDataExternare;
        private TextView mTextDiagnosticExternare;
        private TextView mTextDiagnosticInternare;
        private TextView mTexSpital;
        private TextView mTexTratament;

        public ListViewHolder(View itemView){
            super(itemView);
            mTextDataExternare=(TextView) itemView.findViewById(R.id.textView_data_externare);
            mTextDataInternare=(TextView) itemView.findViewById(R.id.textView_data_internare);
            mTextDiagnosticExternare=(TextView) itemView.findViewById(R.id.textView_diagnostic_externare);
            mTextDiagnosticInternare=(TextView) itemView.findViewById(R.id.textView_diagnostic_internare);
            mTexSpital=(TextView) itemView.findViewById(R.id.spital);
            mTexTratament=(TextView) itemView.findViewById(R.id.textView_tratament);
            itemView.setOnClickListener(this);
        }
        public void bindView(int position){
            mTextDataExternare.setText(MainActivity.InternariList.get(position).getData_externare());
            mTextDataInternare.setText(MainActivity.InternariList.get(position).getData_internare());
            mTextDiagnosticExternare.setText(MainActivity.InternariList.get(position).getDiagnostic_externare());
            mTextDiagnosticInternare.setText(MainActivity.InternariList.get(position).getDiagonstic_internare());
            mTexSpital.setText(MainActivity.InternariList.get(position).getSpital());
            mTexTratament.setText(MainActivity.InternariList.get(position).getTratament());
        }
        public void onClick(View view){

        }
    }
}

