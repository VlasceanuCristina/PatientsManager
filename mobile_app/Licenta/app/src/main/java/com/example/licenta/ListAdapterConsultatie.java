package com.example.licenta;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

public class ListAdapterConsultatie extends RecyclerView.Adapter {
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_consultatie,parent,false);

        return new ListAdapterConsultatie.ListViewHolder(view);
    }
    public void onBindViewHolder(RecyclerView.ViewHolder holder, int position){
        ((ListAdapterConsultatie.ListViewHolder) holder).bindView(position);

    }
    public int getItemCount(){
        return MainActivity.ConsultatiiList.size();
    }
    private class ListViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        private TextView mTextDataConsultatie;
        private TextView mTextOraConsultatie;
        private TextView mTextDiagnosticConsultatie;
        private TextView mTextTratamentConsultatie;
        private TextView mTextPretConsultatie;

        public ListViewHolder(View itemView){
            super(itemView);
            mTextDataConsultatie=(TextView) itemView.findViewById(R.id.textView_data_consultatie);
            mTextOraConsultatie=(TextView) itemView.findViewById(R.id.textView_ora_consultatie);
            mTextDiagnosticConsultatie=(TextView) itemView.findViewById(R.id.textView_diagnostic_consultatie);
            mTextTratamentConsultatie=(TextView) itemView.findViewById(R.id.textView_tratament_consultatie);
            mTextPretConsultatie=(TextView) itemView.findViewById(R.id.textView_pret_consultatie);
            itemView.setOnClickListener(this);
        }
        public void bindView(int position){
            mTextDataConsultatie.setText(MainActivity.ConsultatiiList.get(position).getData_consultatie());
            mTextOraConsultatie.setText(MainActivity.ConsultatiiList.get(position).getOra());
            mTextTratamentConsultatie.setText(MainActivity.ConsultatiiList.get(position).getTratament());
            mTextDiagnosticConsultatie.setText(MainActivity.ConsultatiiList.get(position).getDiagnostic());
            mTextPretConsultatie.setText(MainActivity.ConsultatiiList.get(position).getPret());
        }
        public void onClick(View view){

        }
    }
}
