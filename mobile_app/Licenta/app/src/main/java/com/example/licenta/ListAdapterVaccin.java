package com.example.licenta;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

public class ListAdapterVaccin extends RecyclerView.Adapter {
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_vaccin,parent,false);

        return new ListAdapterVaccin.ListViewHolder(view);
    }
    public void onBindViewHolder(RecyclerView.ViewHolder holder, int position){
        ((ListAdapterVaccin.ListViewHolder) holder).bindView(position);

    }
    public int getItemCount(){
        return MainActivity.VaccinuriList.size();
    }
    private class ListViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        private TextView mTextDenumireVaccin;
        private TextView mTextDataVaccin;

        public ListViewHolder(View itemView){
            super(itemView);
            mTextDenumireVaccin=(TextView) itemView.findViewById(R.id.textView_denumire_vaccin);
            mTextDataVaccin=(TextView) itemView.findViewById(R.id.textView_data_vaccin);
            itemView.setOnClickListener(this);
        }
        public void bindView(int position){
            mTextDenumireVaccin.setText(MainActivity.VaccinuriList.get(position).getDenumire());
            mTextDataVaccin.setText(MainActivity.VaccinuriList.get(position).getData());
        }
        public void onClick(View view){

        }
    }
}
